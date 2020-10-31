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
class ServicesController extends AppController
{
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

    public function citylist(){ 
        $this->loadModel('Cities');      
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id' => 'DESC'])->toArray();
        if(!empty($cities)){   
            foreach ($cities as $key => $value) {
                unset($value['is_active'], $value['created_date']);               
            }            
            $rarray = array(
                'ack' => 1,
                'message' => 'City list found.',
                'cities' => $cities
                );
        }else{
            $rarray = array('ack' => 0,'message' => 'No City found.');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    } 

    public function servicelist(){       
        $services = $this->Services->find()->where(['isActive'=>1])->order(['id' => 'DESC'])->toArray();
        if(!empty($services)){   
            $this->loadModel('Cities');
            $cities=array();
            foreach ($services as $key => $value) {
                $citiesname=array();
                if($value['city_id']!==""){
                    $city=explode(',', $value['city_id']);
                    foreach ($city as $citykey => $cityvalue) {
                         $cityname = $this->Cities->get($cityvalue);
                         $result=array();
                         $result['id']=$cityname['id'];
                         $result['name']=$cityname['name'];
                         array_push($citiesname, $result);            
                    }
                }
                $services[$key]['cities']= $citiesname;
                unset($value['city_id'], $value['slug'],$value['content'], $value['image'],$value['price'], $value['isActive'], $value['createdDate']);
                
            }            
            $rarray = array(
                'ack' => 1,
                'message' => 'Service list found.',
                'services' => $services
                );
        }else{
            $rarray = array('ack' => 0,'message' => 'No Service found.');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }

    public function pricelist(){ 
        $this->loadModel('Prices');      
        $prices = $this->Prices->find()->where()->contain(['Services', 'Cities'])->order(['Prices.id' => 'DESC'])->toArray();
        if(!empty($prices)){   
            foreach ($prices as $key => $value) {
                unset($value['is_active'],$value['created_date'],$value['city_id'],$value['service_id'],
                    $value['city']['is_active'],$value['city']['created_date'],$value['service']['isActive'],
                    $value['service']['createdDate'],$value['service']['slug'],$value['service']['content'],
                    $value['service']['image'],$value['service']['price'], $value['service']['city_id']
                );               
            }            
            $rarray = array(
                'ack' => 1,
                'message' => 'Price list found.',
                'prices' => $prices
                );
        }else{
            $rarray = array('ack' => 0,'message' => 'No Prices found.');
        }
        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    } 

    public function reviewlist(){ 
        if($this->request->is('post')){
            $user_id=isset($this->request->data['user_id'])?$this->request->data['user_id']:"";
            $booking_id=isset($this->request->data['booking_id'])?$this->request->data['booking_id']:"";
            if($user_id!="" || $booking_id!=""){
                $this->loadModel('Reviews'); 
                if($booking_id!=""){
                    $reviews = $this->Reviews->find()->where(['Reviews.booking_id'=>$booking_id, 'Reviews.is_active'=>1])->contain(['Reviewds', 'Reviewers', 'Bookings'])->order(['Reviews.id' => 'DESC'])->toArray();
                }
                if($user_id!=""){
                    $reviews = $this->Reviews->find()->where(['Reviews.to_id'=>$user_id, 'Reviews.is_active'=>1])->contain(['Reviewds', 'Reviewers', 'Bookings'])->order(['Reviews.id' => 'DESC'])->toArray();
                }                
                if(!empty($reviews)){   
                    foreach ($reviews as $key => $value) {
                        unset(
                            $value['to_id'],$value['from_id'],$value['booking_id'],$value['is_reviewer_customer'],
                            $value['is_active'],$value['created_date'],
                            $value['booking']['booking_date'],$value['booking']['booking_time'],$value['booking']['waste_size'],
                            $value['booking']['service_provider_id'],$value['booking']['customer_id'],$value['booking']['service_provided_city_id'],$value['booking']['is_active'],
                            $value['booking']['service_id'],$value['booking']['price_id'],$value['booking']['service_charge'],$value['booking']['created_date'],
                            $value['booking']['service_status'],$value['booking']['service_loaction'],$value['booking']['payment_status'],

                            $value['reviewer']['view_id'],$value['reviewer']['email'],$value['reviewer']['password'],
                            $value['reviewer']['address'],$value['reviewer']['city_id'], $value['reviewer']['company_name'],
                            $value['reviewer']['phoneNumber'],$value['reviewer']['subadmin_access_ids'],$value['reviewer']['rating'],
                            $value['reviewer']['isAdmin'],$value['reviewer']['isActive'], $value['reviewer']['isDeleted'], $value['reviewer']['createdDate'],

                            $value['reviewd']['view_id'],$value['reviewd']['email'],$value['reviewd']['password'],
                            $value['reviewd']['address'],$value['reviewd']['city_id'], $value['reviewd']['company_name'],
                            $value['reviewd']['phoneNumber'],$value['reviewd']['subadmin_access_ids'],$value['reviewd']['rating'],
                            $value['reviewd']['isAdmin'],$value['reviewd']['isActive'], $value['reviewd']['isDeleted'], $value['reviewd']['createdDate']
                        );
                        
                        if($value['reviewd']['profilePicture']==NULL){
                            $reviews[$key]['reviewd']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        }else{
                            $reviews[$key]['reviewd']['profilePicture'] = Router::url('/', true).$value['reviewd']['profilePicture'];
                        }

                        if($value['reviewer']['profilePicture']==NULL){
                            $reviews[$key]['reviewer']['profilePicture'] = Router::url('/', true).'userImg/default.png';
                        }else{
                            $reviews[$key]['reviewer']['profilePicture'] = Router::url('/', true).$value['reviewer']['profilePicture'];
                        }
                    }            
                    $rarray = array(
                        'ack' => 1,
                        'message' => 'Review list found.',
                        'reviews' => $reviews
                        );
                }else{
                    $rarray = array('ack' => 0,'message' => 'No Review found.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'User id or booking id require');
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