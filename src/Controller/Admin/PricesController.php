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
class PricesController extends AppController {
    
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
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $city = @$this->request->query['city'];
        if(@$city!=''){
            $prices = $this->Prices->find()->where(['Prices.city_id'=>$city])->contain(['Services', 'Cities'])->order(['Prices.id' => 'DESC']);
            $this->set(compact('city'));
        } else {
            $prices = $this->Prices->find()->where()->contain(['Services', 'Cities'])->order(['Prices.id' => 'DESC']);
        }   
        $this->set('prices', $this->paginate($prices));
        $this->set(compact('cities'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $price = $this->Prices->newEntity();
        if ($this->request->is('post')) {
            $duplicate = $this->Prices->find()->where(['city_id'=>$this->request->data['city_id'], 'service_id'=>$this->request->data['service_id'], 'size'=>$this->request->data['size']])->first();
            if(empty($duplicate)){
                $price = $this->Prices->patchEntity($price, $this->request->data);
                $result = $this->Prices->save($price);
                if ($result) {
                    $this->Flash->success(__('Price has been added successfully.'));
                    return $this->redirect(['action'=>'index']);                          
                } else {
                    $this->Flash->error(__('Price could not added. Please, try again.'));
                }
            }else{
                $this->Flash->error(__('Price already given against this service and zone.'));
            }
        }

        $this->loadModel('Cities');
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('cities'));
    }

    public function edit($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $price = $this->Prices->get($id);
        if ($this->request->is(['post','put'])) {
            
            $city = $this->Prices->patchEntity($price, $this->request->data);
            if ($this->Prices->save($price)) {
                $this->Flash->success(__('Price has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('Price could not updated. Please, try again.'));
            }
        }
        $this->loadModel('Cities');
        $this->loadModel('Services');
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray(); 
        $services = $this->Services->find()->where(['FIND_IN_SET(\''. $price['city_id'] .'\',city_id)'])->order(['id'=>'DESC'])->toArray(); 
        $this->set(compact('price', 'services','cities'));
    }


    function getService() {
        $city_id=$_POST['city_id'];   
        $output='<select name="service_id" class="form-control" id="service_id">
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
    


    // /**
    //  * delete method
    //  *
    //  * @param string $id
    //  * @return void
    //  */
    public function delete($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $price = $this->Prices->get($id);
        if ($this->Prices->delete($price)) {
            $this->loadModel('Bookings');
            $this->loadModel('Payments');
            $this->loadModel('Accounts');
            $deleteBookings=$this->Bookings->find()->where(['price_id' => $id])->toArray();
            foreach ($deleteBookings as $key => $value) {
                $bookingDelete = $this->Bookings->get($value['id']);
                if ($this->Bookings->delete($bookingDelete)) {
                    if($this->Payments->deleteAll(['booking_id' => $value['id']])){
                        if($this->Accounts->deleteAll(['booking_id' => $value['id']])){
                        }
                    }
                }
                $this->loadModel('Reviews');
                $this->loadModel('Users');
                $deleteReviews=$this->Reviews->find()->where(['booking_id' => $value['id']])->toArray();
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
            }
            $this->Flash->success(__('Price has been deleted.'));
            return $this->redirect(['action'=>'index']);          
        }else {
            $this->Flash->error(__('Price could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function status($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $price = $this->Prices->get($id);
        $status=array();
        $status['is_active']=$price['is_active']==1?0:1;
        $price = $this->Prices->patchEntity($price, $status);
        if ($this->Prices->save($price)) {
            $this->Flash->success(__('Status has been changed successfully.'));
            return $this->redirect(['action'=>'index']);
        } else {
            $this->Flash->error(__('Status can not be change. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }


}
