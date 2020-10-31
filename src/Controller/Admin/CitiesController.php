<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * FaqsController controller
 *
 * This controller will render views from Template/Admin/Faqs/
 *
 */
class CitiesController extends AppController {
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect('/admin');
        }
    }

    public $paginate = [
        'Cities' => [
            'limit' => 9
        ]
    ];

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');

        $cities = $this->Cities->find()->order(['id'=>'ASC']);
        $cities = $this->paginate($cities)->toArray();
        // print_r($faqs); exit;
        $this->set(compact('cities'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
        	$duplicate = $this->Cities->find()->where(['name'=>trim($this->request->data['name']), 'is_active'=>1])->first();
            if(empty($duplicate)){
                $this->request->data['name']=trim($this->request->data['name']);
                $city = $this->Cities->patchEntity($city, $this->request->data);
                if ($this->Cities->save($city)) {
                    $this->Flash->success(__('City has been added successfully.'));
                    return $this->redirect(['action'=>'index']);
                } else {
                    $this->Flash->error(__('City could not added. Please, try again.'));
                }
            }else{
                $this->Flash->success(__('City name already added, please use another.'));
                return $this->redirect(['action'=>'add']);
            }
        }
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $city = $this->Cities->get($id);
        if ($this->request->is(['post','put'])) {
            
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('City has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('City could not updated. Please, try again.'));
            }
        }
        $this->set(compact('city'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Prices');
        $this->loadModel('Services');
        $id = base64_decode($id);
        $this->loadModel('Bookings');
        // $deleteBookings=$this->Bookings->find()->where(['service_provided_city_id' => $id])->toArray();
        // pr($deleteBookings);
        // pr($id);
        // exit();
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            if($this->Prices->deleteAll(['city_id' => $id])){
                $this->loadModel('Bookings');
                $this->loadModel('Payments');
                $this->loadModel('Accounts');
                $deleteBookings=$this->Bookings->find()->where(['service_provided_city_id' => $id])->toArray();
                foreach ($deleteBookings as $key => $value) {
                    $bookingDelete = $this->Bookings->get($value['id']);
                    if ($this->Bookings->delete($bookingDelete)) {
                        if($this->Payments->deleteAll(['booking_id' => $value['id']])){
                            if($this->Accounts->deleteAll(['booking_id' => $value['id']])){
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
                }
                $services = $this->Services->find()->where(['FIND_IN_SET(\''. $id .'\',city_id)'])->order(['id'=>'DESC'])->toArray();
                foreach ($services as $key => $value) {
                    $serviceValues=explode(',',$value['city_id']);
                    if (in_array($id, $serviceValues)){
                        unset($serviceValues[array_search($id,$serviceValues)]);
                        if(count($serviceValues)>0){
                            $service = $this->Services->get($value['id']);
                            $edit=array();
                            $edit['city_id']=implode(",", $serviceValues);
                            $service = $this->Services->patchEntity($service, $edit);
                            if ($this->Services->save($service)) {
                                //$this->Flash->success(__('City has been deleted.'));
                            }
                        }else{
                            $deleteservice = $this->Services->get($value['id']);
                            if($this->Services->delete($deleteservice)){
                                //$this->Flash->success(__('City has been deleted.'));
                            }
                        }
                    }
                }
                $this->Flash->success(__('City has been deleted.'));
            }
        }else {
            $this->Flash->error(__('City could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function status($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $city = $this->Cities->get($id);
        $status=array();
        $status['is_active']=$city['is_active']==1?0:1;
        $city = $this->Cities->patchEntity($city, $status);
        if ($this->Cities->save($city)) {
            $this->Flash->success(__('Status has been changed successfully.'));
            return $this->redirect(['action'=>'index']);
        } else {
            $this->Flash->error(__('Status can not be change. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */

    /**
     * ajaxChangeOrder method
     *
     * change faq order
     * @return json
     */

}
