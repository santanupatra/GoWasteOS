<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * ProductsController controller
 *
 * This controller will render views from Template/Admin/Products/
 *
 */
class BookingsController extends AppController {
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect('/admin');
        }
    }

    public $paginate = [
        'limit' => 9
    ];

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');

        $this->loadModel('Cities');

        $cityid = @$this->request->query['cityid'];
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        
        if(@$cityid!=''){
            $bookings = $this->Bookings->find()->where(['service_provided_city_id'=>$cityid])->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])
                    ->order(['Bookings.id' => 'DESC']);
        } else {
            $bookings = $this->Bookings->find()->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])
                    ->order(['Bookings.id' => 'DESC']);
        }

        $bookings = $this->paginate($bookings);

        // print_r($this->paginate($bookings));
        // exit();
        $this->set(compact('bookings','cities','cityid'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Cities');
        $this->loadModel('Users');
        $this->loadModel('Services');
        $this->loadModel('Payments');
        $this->loadModel('Accounts');
        $this->loadModel('Settings');
        $this->loadModel('Prices');
        $settings = $this->Settings->get(1);
        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
            // pr($this->request->data) ;
            // exit();
            $date = str_replace('/', '-', $this->request->data['booking_date']);
            $this->request->data['booking_date']=date('Y-m-d', strtotime($date));
            $this->request->data['booking_time']=gmdate('H:i', strtotime($this->request->data['booking_time']));
            //$duplicate=$this->Bookings->find()->where(['service_provider_id'=>$this->request->data['service_provider_id'], 'booking_date'=>$this->request->data['booking_date'],'booking_time'=>date("H:i:s",strtotime($this->request->data['booking_time']))])->first();
            //if(empty($duplicate)){
                $service = $this->Services->get($this->request->data['service_id']);
                $priceSize = $this->Prices->get($this->request->data['size']);
                $this->request->data['service_charge']=$priceSize['price'];
                $this->request->data['waste_size']=$priceSize['size'].' '.$service['unit'];
                $this->request->data['price_id']=$this->request->data['size'];
                $this->request->data['payment_status']=1;
                
                $booking = $this->Bookings->patchEntity($booking, $this->request->data);
                $result = $this->Bookings->save($booking);
                $insertedId = $result->id;
                if ($result) {
                    $bookinEdit = $this->Bookings->get($insertedId);
                    $status=array();
                    $status['view_id']='BOOK000'.$insertedId;
                    $bookinEdit = $this->Bookings->patchEntity($bookinEdit, $status);
                    if($this->Bookings->save($bookinEdit)){
                        $total_service_charge=$priceSize['price'];
                        $municipality_charge=($total_service_charge)*($settings['municipalityCharge']/100);
                        $total_amount=$municipality_charge+$total_service_charge; 
                        $payment = $this->Payments->newEntity();
                        $paymentStatus=array();
                        $paymentStatus['booking_id']=$insertedId;   
                        $paymentStatus['booking_view_id']='BOOK000'.$insertedId;   
                        $paymentStatus['service_charge']=$total_service_charge;   
                        $paymentStatus['municipality_charge']=$municipality_charge;   
                        $paymentStatus['total_amount']=$total_amount;
                        $paymentStatus['currency']='NGN';   
                        $paymentStatus['transaction_id']='XXXXX-XXXX-XXXX';   
                        $paymentStatus['payment_method']="Cash";   
                        $paymentStatus['payment_status']=1;   
                        $payment = $this->Payments->patchEntity($payment, $paymentStatus);
                        if($this->Payments->save($payment)){
    
                           //For Service Provider 
                            $accountSP = $this->Accounts->newEntity();
                            $accountStatus=array();
                            $accountStatus['user_id']=$this->request->data['service_provider_id'];   
                            $accountStatus['user_type']='SP';   
                            $accountStatus['transaction_type']='C';   
                            $accountStatus['total_service_charge']=$total_service_charge;   
                            $accountStatus['municipality_charge']=$municipality_charge;   
                            $accountStatus['total_amount_transferred']=$total_service_charge;                         
                            $accountStatus['booking_id']=$insertedId;   
                            $accountStatus['booking_view_id']='BOOK000'.$insertedId;   
                            $accountSP = $this->Accounts->patchEntity($accountSP, $accountStatus);
                            if($this->Accounts->save($accountSP)){
    
                            //For Customer 
                            $accountC = $this->Accounts->newEntity();
                            $accountStatus=array();
                            $accountStatus['user_id']=$this->request->data['customer_id'];  
                            $accountStatus['user_type']='C';  
                            $accountStatus['transaction_type']='D';   
                            $accountStatus['total_service_charge']=$total_service_charge;   
                            $accountStatus['municipality_charge']=$municipality_charge;   
                            $accountStatus['total_amount_transferred']=$total_amount;                         
                            $accountStatus['booking_id']=$insertedId;   
                            $accountStatus['booking_view_id']='BOOK000'.$insertedId;   
                            $accountC = $this->Accounts->patchEntity($accountC, $accountStatus);
                                if($this->Accounts->save($accountC)){
                                    $this->Flash->success(__('Booking has been added successfully.'));
                                    return $this->redirect(['action'=>'index']);
                                }
                            }
                        }
                    }
                } else {
                    $this->Flash->error(__('Booking could not added. Please, try again.'));
                }
            // }else{
            //     $this->Flash->error(__('Service provider is not available at this time'));
            // }
        }

        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $customers = $this->Users->find()->where(['isActive'=>1,'isDeleted'=>0,'type'=>'C'])->order(['id'=>'DESC'])->toArray();
        $service_providers = $this->Users->find()->where(['isActive'=>1, 'isDeleted'=>0,'type'=>'SP'])->order(['id'=>'DESC'])->toArray();
        $services = $this->Services->find()->where(['isActive'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('cities', 'customers', 'service_providers', 'services'));
    }

    function getService() {
        $city_id=$_POST['city_id'];   
        $output='<select name="service_id" class="form-control" id="service_id" onchange="getPrice()">
        <option value="">Select Service</option>>';
        if(isset($city_id)){
            $this->loadModel('Services');
            $service=$this->Services->find()->where(['FIND_IN_SET(\''. $city_id .'\',city_id)', 'isActive'=>1])->order(['id'=>'DESC'])->toArray();;            
            if(!empty($service)){
                foreach ($service as $key => $value) {
                $output .='<option value="'.$value['id'].'">'.$value['title'].'</option>';                
                }
            }else{
                $output .='<option value="">No Service Found</option>';
            }            
        }else{
            $output .='<option value="">No Service Found</option>';
        }
        $output .='</select>';
        echo $output; exit();
    }

    function getPrice() {
        $service_id=$_POST['service_id'];   
        $city_id=$_POST['city_id'];   
        $output='<select name="size" class="form-control" id="price_id">
        <option value="">Select Price</option>>';
        if(isset($service_id) && isset($city_id)){
            $this->loadModel('Prices');
            $prices=$this->Prices->find()->where(['is_active'=>1, 'service_id'=>$service_id, 'city_id'=>$city_id])->order(['id'=>'DESC'])->toArray();;            
            if(!empty($prices)){
                foreach ($prices as $key => $value) {
                $output .='<option value="'.$value['id'].'">'.$value['category'].'(₦ '.$value['price'].'/'.$value['size'].')'.'</option>';                
                }
            }else{
                $output .='<option value="">No Price Found with respect to this service and zone.</option>';
            }            
        }else{
            $output .='<option value="">No Price Found</option>';
        }
        $output .='</select>';
        echo $output; exit();
    }


    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Payments');
        $this->loadModel('Accounts');
        $id = base64_decode($id);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            if($this->Payments->deleteAll(['booking_id' => $id])){
                if($this->Accounts->deleteAll(['booking_id' => $id])){
                    $this->loadModel('Reviews');
                    $this->loadModel('Users');
                    $deleteReviews=$this->Reviews->find()->where(['booking_id' => $id])->toArray();
                    foreach ($deleteReviews as $reviewkey => $reviewvalue) {
                        $review = $this->Reviews->get($reviewvalue['id']);
                        if ($this->Reviews->delete($review)) {
                            $reviewsAll = $this->Reviews->find()->where(['is_active'=>1, 'to_id'=>$reviewvalue['to_id']])->toArray();
                            $avgRating=0;
                            $reviewCount=0;
                            if(!empty($reviewsAll)){
                                foreach ($reviewsAll as $reviewsAllkey => $reviewsAllvalue) {
                                    $reviewCount+=$reviewsAllvalue['rating'];
                                }
                                $avgRating=$reviewCount/count($reviewsAll);
                            }
                
                            $userEdit = $this->Users->get($reviewvalue['to_id']);
                            $status=array();
                            $status['rating']=$avgRating;
                            $userEdit = $this->Users->patchEntity($userEdit, $status);
                            if($this->Users->save($userEdit)){
    
                            }
                           
                        }
                    }
                    $this->Flash->success(__('Booking has been deleted.'));
                }
            }
        }else {
            $this->Flash->error(__('Booking could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function view($id = null){
        $this->loadModel('Cities');
        $this->loadModel('Users');
        $this->loadModel('Services');
        $this->loadModel('Payments');
        $id = base64_decode($id);
        $booking = $this->Bookings->find()->where(['Bookings.id'=>$id])->contain(['Payments', 'Services', 'Cities', 'Providers', 'Customers'])->first();
        $this->set(compact('booking'));
    }
}
