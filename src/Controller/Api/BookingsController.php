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
class BookingsController extends AppController
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
    
}