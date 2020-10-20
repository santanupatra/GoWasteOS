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

        $bookings = $this->Bookings->find()->order(['id' => 'DESC']);;
        $this->set('bookings', $this->paginate($bookings));
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
        $booking = $this->Bookings->newEntity();
        if ($this->request->is('post')) {
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
                    $payment = $this->Payments->newEntity();
                    $paymentStatus=array();
                    $paymentStatus['booking_id']=$insertedId;   
                    $paymentStatus['booking_view_id']='BOOK000'.$insertedId;   
                    $paymentStatus['service_charge']=$service['price'];   
                    $paymentStatus['municipality_charge']=0.00;   
                    $paymentStatus['total_amount']=$service['price'];   
                    $paymentStatus['currency']='Cent';   
                    $paymentStatus['transaction_id']='XXXXX-XXXX-XXXX';   
                    $paymentStatus['payment_method']=1;   
                    $paymentStatus['payment_status']='Cash';   
                    $payment = $this->Payments->patchEntity($payment, $paymentStatus);
                    if($this->Payments->save($payment)){
                        $this->Flash->success(__('Booking has been added successfully.'));
                        return $this->redirect(['action'=>'index']);
                    }
                }
        	} else {
        		$this->Flash->error(__('Booking could not added. Please, try again.'));
        	}
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
        $id = base64_decode($id);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('Booking has been deleted.'));
        }else {
            $this->Flash->error(__('Booking could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function status($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $booking = $this->Bookings->get($id);
        $status=array();
        $status['is_active']=$booking['is_active']==1?0:1;
        $city = $this->Bookings->patchEntity($booking, $status);
        if ($this->Bookings->save($booking)) {
            $this->Flash->success(__('Status has been changed successfully.'));
            return $this->redirect(['action'=>'index']);
        } else {
            $this->Flash->error(__('Status can not be change. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function view($id = null){
        $id = base64_decode($id);
        $booking = $this->Bookings->get($id);
        $this->set(compact('booking'));
    }
}
