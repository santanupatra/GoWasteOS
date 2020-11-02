<?php
namespace App\Controller\Api;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
class BookingsController extends AppController{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(event $event) { //if you dont have this beforeFilter already
        if ($this->request->is('options')) {
            return $this->response;
        }
    }

    public function bookingdetails(){ 
        if($this->request->is('post')){
            $booking_id=isset($this->request->data['booking_id'])?$this->request->data['booking_id']:"";
            if($booking_id!=""){
                $booking = $this->Bookings->find()->where(['Bookings.id'=>$booking_id])->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])->first();
                if($booking){
                    unset(
                        $booking['city']['is_active'],$booking['city']['created_date'],$booking['service']['isActive'],
                        $booking['service']['createdDate'],$booking['service']['slug'],$booking['service']['content'],
                        $booking['service']['image'],$booking['service']['price'], $booking['service']['city_id'],

                        $booking['booking']['service_provider_id'],$booking['booking']['customer_id'],$booking['booking']['service_provided_city_id'],
                        $booking['booking']['service_id'],$booking['booking']['price_id'],$booking['booking']['is_active'],$booking['booking']['created_date'],

                        $booking['customer']['view_id'],$booking['customer']['email'],$booking['customer']['password'],
                        $booking['customer']['address'],$booking['customer']['city_id'], $booking['customer']['company_name'],
                        $booking['customer']['phoneNumber'],$booking['customer']['subadmin_access_ids'],$booking['customer']['rating'],
                        $booking['customer']['isAdmin'],$booking['customer']['isActive'], $booking['customer']['isDeleted'], $booking['customer']['createdDate'],

                        $booking['provider']['view_id'],$booking['provider']['email'],$booking['provider']['password'],
                        $booking['provider']['address'],$booking['provider']['city_id'], $booking['provider']['company_name'],
                        $booking['provider']['phoneNumber'],$booking['provider']['subadmin_access_ids'],$booking['provider']['rating'],
                        $booking['provider']['isAdmin'],$booking['provider']['isActive'], $booking['provider']['isDeleted'], $booking['provider']['createdDate'],

                        $booking['payment']['booking_id'],$booking['payment']['booking_view_id'],$booking['payment']['is_active'],
                        $booking['payment']['createdDate'],$booking['payment']['isActive']
                    );
                    
                    if($booking['customer']['profilePicture']==NULL){
                        $booking['customer']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                    }else{
                        $booking['customer']['profilePicture'] = Router::url('/', true).$booking['customer']['profilePicture'];
                    }

                    if($booking['provider']['profilePicture']==NULL){
                        $booking['provider']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                    }else{
                        $booking['provider']['profilePicture'] = Router::url('/', true).$booking['provider']['profilePicture'];
                    }
                    $rarray = array(
                        'ack' => 1,
                        'message' => 'Booking details found.',
                        'bookings_details' => $booking
                        );
                }else{
                    $rarray = array('ack' => 0,'message' => 'No Booking found.');
                }                                
            }else{
                $rarray = array('ack' => 0,'message' => 'Booking id require');
            }
        }else{
            $rarray = array('ack' => 0,'message' => 'Data missing');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    } 

    public function bookinglist(){ 
        if($this->request->is('post')){
            $customer_id=isset($this->request->data['customer_id'])?$this->request->data['customer_id']:"";
            $service_provider_id=isset($this->request->data['service_provider_id'])?$this->request->data['service_provider_id']:"";
            if($customer_id!="" || $service_provider_id!=""){
                if($customer_id!=""){
                    $bookings = $this->Bookings->find()->where(['customer_id'=>$customer_id])->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])
                    ->order(['Bookings.id' => 'DESC'])->toArray();
                }
                if($service_provider_id!=""){
                    $bookings = $this->Bookings->find()->where(['service_provider_id'=>$service_provider_id, 'is_active'=>1])->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])
                    ->order(['Bookings.id' => 'DESC'])->toArray();
                }                
                if(!empty($bookings)){   
                    foreach ($bookings as $key => $value) {
                        unset(
                            $value['city']['is_active'],$value['city']['created_date'],$value['service']['isActive'],
                            $value['service']['createdDate'],$value['service']['slug'],$value['service']['content'],
                            $value['service']['image'],$value['service']['price'], $value['service']['city_id'],

                            $value['booking']['service_provider_id'],$value['booking']['customer_id'],$value['booking']['service_provided_city_id'],
                            $value['booking']['service_id'],$value['booking']['price_id'],$value['booking']['is_active'],$value['booking']['created_date'],

                            $value['customer']['view_id'],$value['customer']['email'],$value['customer']['password'],
                            $value['customer']['address'],$value['customer']['city_id'], $value['customer']['company_name'],
                            $value['customer']['phoneNumber'],$value['customer']['subadmin_access_ids'],$value['customer']['rating'],
                            $value['customer']['isAdmin'],$value['customer']['isActive'], $value['customer']['isDeleted'], $value['customer']['createdDate'],

                            $value['provider']['view_id'],$value['provider']['email'],$value['provider']['password'],
                            $value['provider']['address'],$value['provider']['city_id'], $value['provider']['company_name'],
                            $value['provider']['phoneNumber'],$value['provider']['subadmin_access_ids'],$value['provider']['rating'],
                            $value['provider']['isAdmin'],$value['provider']['isActive'], $value['provider']['isDeleted'], $value['provider']['createdDate'],

                            $value['payment']['booking_id'],$value['payment']['booking_view_id'],$value['payment']['is_active'],
                            $value['payment']['createdDate'],$value['payment']['isActive']
                        );
                        
                        if($value['customer']['profilePicture']==NULL){
                            $bookings[$key]['customer']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        }else{
                            $bookings[$key]['customer']['profilePicture'] = Router::url('/', true).$value['customer']['profilePicture'];
                        }

                        if($value['provider']['profilePicture']==NULL){
                            $bookings[$key]['provider']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        }else{
                            $bookings[$key]['provider']['profilePicture'] = Router::url('/', true).$value['provider']['profilePicture'];
                        }
                    }            
                    $rarray = array(
                        'ack' => 1,
                        'message' => 'Booking list found.',
                        'bookings' => $bookings
                        );
                }else{
                    $rarray = array('ack' => 0,'message' => 'No Booking found.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'Customer id or service provider id require');
            }
        }else{
            $rarray = array('ack' => 0,'message' => 'Data missing');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }

    public function jobpost(){
        if($this->request->is('post')){
            $customer_id=isset($this->request->data['customer_id'])?$this->request->data['customer_id']:"";
            $price_id=isset($this->request->data['price_id'])?$this->request->data['price_id']:"";
            $location=isset($this->request->data['location'])?$this->request->data['location']:"";
            $lattitude=isset($this->request->data['lattitude'])?$this->request->data['lattitude']:"";
            $longitude=isset($this->request->data['longitude'])?$this->request->data['longitude']:"";
            $date=isset($this->request->data['date'])?$this->request->data['date']:"";
            $time=isset($this->request->data['time'])?$this->request->data['time']:"";
            if($customer_id!="" && $price_id!="" && $location!="" && $lattitude!="" && $longitude!="" && $date!="" && $time!=""){
                $this->loadModel('Jobs'); 
                $this->loadModel('Prices'); 
                $this->loadModel('Users'); 
                $isPriceAvailable = $this->Prices->find()->where(['id'=>$this->request->data['price_id'], 'is_active'=>1])->first();
                if(!empty($isPriceAvailable)){
                    $isCustomerAvailable = $this->Users->find()->where(['id'=>$this->request->data['customer_id'], 'isActive'=>1, 'isDeleted'=>0, 'type'=>'C'])->first();               
                    if(!empty($isCustomerAvailable)){
                        $date = str_replace('/', '-', $this->request->data['date']);
                        $this->request->data['date']=date('Y-m-d', strtotime($date));
                        $this->request->data['time']=gmdate('H:i', strtotime($this->request->data['time']));
                        $duplicate = $this->Jobs->find()->where([
                        'customer_id'=>$this->request->data['customer_id'],
                        'price_id'=>$this->request->data['price_id'],
                        'lattitude'=>$this->request->data['lattitude'],
                        'longitude'=>$this->request->data['longitude'],
                        'date'=>$this->request->data['date'],
                        'time'=>$this->request->data['time'],
                        ])->first();
                        if(empty($duplicate)){
                            $jobdata = $this->Jobs->newEntity();
                            $jobdata = $this->Jobs->patchEntity($jobdata, $this->request->data);
                            if ($this->Jobs->save($jobdata)) {
                                // $etRegObj = TableRegistry::get('EmailTemplates');
                                // $emailTemp = $etRegObj->find()->where(['id' => 2])->first()->toArray();
            
                                // $chkPost = base64_encode($rs->id . "/" . $themail);
                                // $mail_To = $themail;
                                // $mail_subject = $emailTemp['subject'];
                                // $url = Router::url('/', true);
                                // $link = $url . 'users/activeaccount/' . $chkPost;
            
                                // $mail_body = str_replace(array('[NAME]', '[LINK]'), array($this->request->data['first_name'], $link), $emailTemp['content']);
                                
                                // $email = new Email('default');
                                // $email->emailFormat('html')
                                //         ->to($mail_To)
                                //         ->subject($mail_subject)
                                //         ->send($mail_body);
                                $rarray = array('ack' => 1,'message' => 'Job posted successfully!');
                            } else {
                                $rarray = array('ack' => 0, 'message' => 'Job post faliure!');
                            }
                        }else{
                            $rarray = array('ack' => 0,'message' => 'This customer has already posted for this job!');
                        }
                    }else{
                        $rarray = array('ack' => 0, 'message' => 'Sorry! Customer is not available.');
                    }
                }else{
                    $rarray = array('ack' => 0, 'message' => 'Sorry! Price is not available.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'Data missing. Customer id, price id, location, lattitude, longitude, date and time require');
            }
        } else {
            $rarray = array('ack' => 0,'message' => 'Data missing.');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }

    public function joblist(){ 
        if($this->request->is('post')){
            $customer_id=isset($this->request->data['customer_id'])?$this->request->data['customer_id']:"";
            if($customer_id!=""){
                $this->loadModel('Jobs'); 
                $this->loadModel('Services'); 
                $this->loadModel('Cities'); 
                $isJobAvailable = $this->Jobs->find('all')->where(['customer_id'=>$this->request->data['customer_id']])
                ->contain(['Prices'])
                ->order(['Jobs.id' => 'DESC'])->toArray();
                if(!empty($isJobAvailable)){   
                    foreach ($isJobAvailable as $key => $value) {
                        $isServiceAvailable = $this->Services->find()->where(['id'=>$value['price']['service_id']])->first();
                        $isJobAvailable[$key]['service']=array('id'=>$isServiceAvailable['id'],
                                                             'title'=>$isServiceAvailable['title'],
                                                             'unit'=>$isServiceAvailable['unit']);
                        $isCityAvailable = $this->Cities->find()->where(['id'=>$value['price']['city_id']])->first();
                        $isJobAvailable[$key]['city']=array('id'=>$isCityAvailable['id'],
                        'name'=>$isCityAvailable['name']);
                        unset(
                            $value['is_active'],$value['created_date'],$value['price_id'],

                            $value['price']['is_active'],$value['price']['created_date'],
                            $value['price']['service_id'],$value['price']['city_id']

                            // $value['customer']['view_id'],$value['customer']['email'],$value['customer']['password'],
                            // $value['customer']['address'],$value['customer']['city_id'], $value['customer']['company_name'],
                            // $value['customer']['phoneNumber'],$value['customer']['subadmin_access_ids'],$value['customer']['rating'],
                            // $value['customer']['isAdmin'],$value['customer']['isActive'], $value['customer']['isDeleted'], $value['customer']['createdDate']
                        );
                        
                        // if($value['customer']['profilePicture']==NULL){
                        //     $isJobAvailable[$key]['customer']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        // }else{
                        //     $isJobAvailable[$key]['customer']['profilePicture'] = Router::url('/', true).$value['customer']['profilePicture'];
                        // }
                    }           
                    $rarray = array(
                        'ack' => 1,
                        'message' => 'Job list found.',
                        'jobs' => $isJobAvailable
                    );
                }else{
                    $rarray = array('ack' => 0,'message' => 'No Job found.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'Customer id require');
            }
        }else{
            $rarray = array('ack' => 0,'message' => 'Data missing');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }

    public function jobdetails(){ 
        if($this->request->is('post')){
            $job_id=isset($this->request->data['job_id'])?$this->request->data['job_id']:"";
            if($job_id!=""){
                $this->loadModel('Jobs'); 
                $this->loadModel('Services'); 
                $this->loadModel('Cities'); 
                $isJobAvailable = $this->Jobs->find('all')->where(['Jobs.id'=>$this->request->data['job_id']])
                ->contain(['Prices'])->first();
                if(!empty($isJobAvailable)){   
                    
                        $isServiceAvailable = $this->Services->find()->where(['id'=>$isJobAvailable['price']['service_id']])->first();
                        $isJobAvailable['service']=array('id'=>$isServiceAvailable['id'],
                                                             'title'=>$isServiceAvailable['title'],
                                                             'unit'=>$isServiceAvailable['unit']);
                        $isCityAvailable = $this->Cities->find()->where(['id'=>$isJobAvailable['price']['city_id']])->first();
                        $isJobAvailable['city']=array('id'=>$isCityAvailable['id'],
                        'name'=>$isCityAvailable['name']);
                        unset(
                            $isJobAvailable['is_active'],$isJobAvailable['created_date'],$isJobAvailable['price_id'],

                            $isJobAvailable['price']['is_active'],$isJobAvailable['price']['created_date'],
                            $isJobAvailable['price']['service_id'],$isJobAvailable['price']['city_id']

                            // $value['customer']['view_id'],$value['customer']['email'],$value['customer']['password'],
                            // $value['customer']['address'],$value['customer']['city_id'], $value['customer']['company_name'],
                            // $value['customer']['phoneNumber'],$value['customer']['subadmin_access_ids'],$value['customer']['rating'],
                            // $value['customer']['isAdmin'],$value['customer']['isActive'], $value['customer']['isDeleted'], $value['customer']['createdDate']
                        );
                        
                        // if($value['customer']['profilePicture']==NULL){
                        //     $isJobAvailable[$key]['customer']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        // }else{
                        //     $isJobAvailable[$key]['customer']['profilePicture'] = Router::url('/', true).$value['customer']['profilePicture'];
                        // }
                               
                    $rarray = array(
                        'ack' => 1,
                        'message' => 'Job Details found.',
                        'job_details' => $isJobAvailable
                    );
                }else{
                    $rarray = array('ack' => 0,'message' => 'No Job found.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'Job id require');
            }
        }else{
            $rarray = array('ack' => 0,'message' => 'Data missing');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }
    //Around 200 meter
    public function nearbyusers(){ 
        if($this->request->is('post')){
            $user_id=isset($this->request->data['user_id'])?$this->request->data['user_id']:"";
            if($user_id!=""){
                $this->loadModel('Users'); 
                $isUserAvailable = $this->Users->find()->where(['id'=>$this->request->data['user_id']])->first();
                if(!empty($isUserAvailable)){ 
                    if($isUserAvailable['lattitude']!=NULL && $isUserAvailable['longitude']){
                        $conn = $this->Users->getConnection();
                        $stmtCustomers = $conn->execute("SELECT
                        id,firstName,lastName, profilePicture, (
                            6371 * acos (
                            cos ( radians(".$isUserAvailable['lattitude'].") )
                            * cos( radians( lattitude ) )
                            * cos( radians( longitude ) - radians(".$isUserAvailable['longitude'].") )
                            + sin ( radians(".$isUserAvailable['lattitude'].") )
                            * sin( radians( lattitude ) )
                            )
                        ) AS distance 
                        FROM `users`
                        WHERE `type`= 'C' AND `isActive`=1 AND `isDeleted`=0
                        HAVING distance < 200
                        ORDER BY distance");
                        $customers = $stmtCustomers->fetchAll('assoc');
    
                        $stmtProviders = $conn->execute("SELECT
                        id,firstName,lastName, profilePicture, (
                            6371 * acos (
                            cos ( radians(".$isUserAvailable['lattitude'].") )
                            * cos( radians( lattitude ) )
                            * cos( radians( longitude ) - radians(".$isUserAvailable['longitude'].") )
                            + sin ( radians(".$isUserAvailable['lattitude'].") )
                            * sin( radians( lattitude ) )
                            )
                        ) AS distance 
                        FROM `users`
                        WHERE `type`= 'SP' AND `isActive`=1 AND `isDeleted`=0
                        HAVING distance < 200
                        ORDER BY distance");
                        $providers = $stmtProviders->fetchAll('assoc');
                        foreach ($providers as $key => $value) {
                            if($value['profilePicture']==NULL){
                                $providers[$key]['profilePicture'] = Router::url('/', true).'userImg/default.png';
                            }else{
                                $providers[$key]['profilePicture'] = Router::url('/', true).$value['profilePicture'];
                            }
                        }
                        foreach ($customers as $key => $value) {
                            if($value['profilePicture']==NULL){
                                $customers[$key]['profilePicture'] = Router::url('/', true).'userImg/default.png';
                            }else{
                                $customers[$key]['profilePicture'] = Router::url('/', true).$value['profilePicture'];
                            }
                        }
                                   
                        $rarray = array(
                            'ack' => 1,
                            'message' => 'Nearby Users found.',
                            'customers' => $customers,
                            'providers' => $providers,
                        );
                    }else{
                        $rarray = array('ack' => 0,'message' => 'Lattitude longitude value of this user is not available.');
                    }
                }else{
                    $rarray = array('ack' => 0,'message' => 'No User found.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'User id require');
            }
        }else{
            $rarray = array('ack' => 0,'message' => 'Data missing');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }
    
}