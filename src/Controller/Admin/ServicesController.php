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
        'limit' => 15
    ];

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');

        $services = $this->Services->find()->order(['id' => 'DESC']);
        $this->set('services', $this->paginate($services));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            // print_r($this->request->data); exit;
            if($this->request->data['image']['name'] != '') {
                $pathpart=pathinfo($this->request->data['image']['name']);
                $arrExt = array('jpg', 'jpeg', 'png','webp');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $uploadFolder = "service_image/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['image']['tmp_name'],$full_flg_path);                        
                    $this->request->data['image'] = "service_image/".$filename;
                } else {
                    $this->Flash->error(__('icon Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'add']);
                }
            }
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
        $id = base64_decode($id);
        $service = $this->Services->get($id);
        if ($this->request->is(['post','put'])) {
            if($this->request->data['image']['name'] != '') {
                $pathpart=pathinfo($this->request->data['image']['name']);
                $arrExt = array('jpg', 'jpeg', 'png','webp');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $uploadFolder = "service_image/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['image']['tmp_name'],$full_flg_path);                        
                    $this->request->data['image'] = "service_image/".$filename;
                } else {
                    $this->Flash->error(__('service Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'edit']);
                }
            } else {
                $this->request->data['image'] = $this->request->data['oldImg'];
            }
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
            $this->Flash->success(__('Services has been deleted.'));
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


