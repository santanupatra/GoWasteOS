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
        'limit' => 15
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
        $settings = $this->Settings->get(1);
        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->data['booking_time']); exit();
            $this->request->data['booking_date']=date("Y-m-d",strtotime($this->request->data['booking_date']));
            //$duplicate=$this->Bookings->find()->where(['service_provider_id'=>$this->request->data['service_provider_id'], 'booking_date'=>$this->request->data['booking_date'],'booking_time'=>date("H:i:s",strtotime($this->request->data['booking_time']))])->first();
            //if(empty($duplicate)){
                $service = $this->Services->get($this->request->data['service_id']);
                $this->request->data['service_charge']=$service['price'];
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
                        $total_service_charge=$service['price']*$this->request->data['waste_size'];
                        $municipality_charge=($total_service_charge)*($settings['municipalityCharge']/100);
                        $total_amount=$municipality_charge+$total_service_charge; 
                        $payment = $this->Payments->newEntity();
                        $paymentStatus=array();
                        $paymentStatus['booking_id']=$insertedId;   
                        $paymentStatus['booking_view_id']='BOOK000'.$insertedId;   
                        $paymentStatus['service_charge']=$total_service_charge;   
                        $paymentStatus['municipality_charge']=$municipality_charge;   
                        $paymentStatus['total_amount']=$total_amount;
                        $paymentStatus['currency']='Cent';   
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
        $customers = $this->Users->find()->where(['isActive'=>1, 'type'=>'C'])->order(['id'=>'DESC'])->toArray();
        $service_providers = $this->Users->find()->where(['isActive'=>1, 'type'=>'SP'])->order(['id'=>'DESC'])->toArray();
        $services = $this->Services->find()->where(['isActive'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('cities', 'customers', 'service_providers', 'services'));
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
