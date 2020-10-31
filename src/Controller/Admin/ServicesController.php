<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * ServicesController controller
 *
 * This controller will render views from Template/Admin/Services/
 *
 */
class ServicesController extends AppController {
    
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
        $services = $this->Services->find()->order(['id' => 'DESC']);
        $cities=array();
        foreach ($this->paginate($services) as $key => $value) {
            $citiesname=array();
            if($value['city_id']!==""){
                $city=explode(',', $value['city_id']);
                foreach ($city as $citykey => $cityvalue) {
                     $cityname = $this->Cities->get($cityvalue);
                     array_push($citiesname, $cityname['name']);            
                }
            }
             array_push($cities, $citiesname);
        }        
            
        $this->set('services', $this->paginate($services));
        $this->set(compact('cities'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Cities');
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('cities'));
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            // print_r($this->request->data); exit;
            // if($this->request->data['image']['name'] != '') {
            //     $pathpart=pathinfo($this->request->data['image']['name']);
            //     $arrExt = array('jpg', 'jpeg', 'png','webp');
            //     $ext = $pathpart['extension'];
            //     if (in_array($ext, $arrExt)) {
            //         $uploadFolder = "service_image/";
            //         $uploadPath = WWW_ROOT . $uploadFolder;
            //         $filename = uniqid().".".$ext;
            //         $full_flg_path = $uploadPath . '/' . $filename;
            //         move_uploaded_file($this->request->data['image']['tmp_name'],$full_flg_path);                        
            //         $this->request->data['image'] = "service_image/".$filename;
            //     } else {
            //         $this->Flash->error(__('icon Only jpg,jpeg,png Files.'));
            //         return $this->redirect(['action'=>'add']);
            //     }
            // }
            $this->request->data['city_id']=implode(",", $this->request->data['city_id']);
        	$service = $this->Services->patchEntity($service, $this->request->data);
        	if ($this->Services->save($service)) {
        		$this->Flash->success(__('Services has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('Services could not added. Please, try again.'));
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
        $this->loadModel('Cities');
        $cities = $this->Cities->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('cities'));
        $id = base64_decode($id);
        $service = $this->Services->get($id);
        if ($this->request->is(['post','put'])) {
            // if($this->request->data['image']['name'] != '') {
            //     $pathpart=pathinfo($this->request->data['image']['name']);
            //     $arrExt = array('jpg', 'jpeg', 'png','webp');
            //     $ext = $pathpart['extension'];
            //     if (in_array($ext, $arrExt)) {
            //         $uploadFolder = "service_image/";
            //         $uploadPath = WWW_ROOT . $uploadFolder;
            //         $filename = uniqid().".".$ext;
            //         $full_flg_path = $uploadPath . '/' . $filename;
            //         move_uploaded_file($this->request->data['image']['tmp_name'],$full_flg_path);                        
            //         $this->request->data['image'] = "service_image/".$filename;
            //     } else {
            //         $this->Flash->error(__('service Only jpg,jpeg,png Files.'));
            //         return $this->redirect(['action'=>'edit']);
            //     }
            // } else {
            //     $this->request->data['image'] = $this->request->data['oldImg'];
            // }
            $this->request->data['city_id']=implode(",", $this->request->data['city_id']);
            $service = $this->Services->patchEntity($service, $this->request->data);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('Services has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('Services could not updated. Please, try again.'));
            }
        }
        $this->set(compact('service'));
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
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->loadModel('Prices');
            if($this->Prices->deleteAll(['service_id' => $id])){
                $this->loadModel('Bookings');
                $this->loadModel('Payments');
                $this->loadModel('Accounts');
                $deleteBookings=$this->Bookings->find()->where(['service_id' => $id])->toArray();
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
                $this->Flash->success(__('Services has been deleted.'));
            }   
        }else {
            $this->Flash->error(__('Services could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function status($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $service = $this->Services->get($id);
        $status=array();
        $status['isActive']=$service['isActive']==1?0:1;
        $service = $this->Services->patchEntity($service, $status);
        if ($this->Services->save($service)) {
            $this->Flash->success(__('Status has been changed successfully.'));
            return $this->redirect(['action'=>'index']);
        } else {
            $this->Flash->error(__('Status can not be change. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }
}


