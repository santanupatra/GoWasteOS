<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * BannersController controller
 *
 * This controller will render views from Template/Admin/Banners/
 *
 */
class BannersController extends AppController {
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect('/admin');
        }
    }
    public $paginate = [
        'limit' => 10
    ];

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');

        $banners = $this->Banners->find()->order(['id' => 'DESC']);;
        // print_r($Banners); exit;
        $this->set('banners', $this->paginate($banners));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $banner = $this->Banners->newEntity();
        if ($this->request->is('post')) {
            // print_r($this->request->data); exit;
            if($this->request->data['bannerImage']['name'] != '') {
                $pathpart=pathinfo($this->request->data['bannerImage']['name']);
                $arrExt = array('jpg', 'jpeg', 'png','JPG');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $uploadFolder = "banner/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['bannerImage']['tmp_name'],$full_flg_path);                        
                    $this->request->data['bannerImage'] = "banner/".$filename;
                } else {
                    $this->Flash->error(__('Banner Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'add']);
                }
            } 
        	$banner = $this->Banners->patchEntity($banner, $this->request->data);
        	if ($this->Banners->save($banner)) {
        		$this->Flash->success(__('Banners has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('Banners could not added. Please, try again.'));
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
        $banners = $this->Banners->get($id);
        if ($this->request->is(['post','put'])) {
            if($this->request->data['bannerImage']['name'] != '') {
                $pathpart=pathinfo($this->request->data['bannerImage']['name']);
                $arrExt = array('jpg','jpeg','png','JPG');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $uploadFolder = "banner/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['bannerImage']['tmp_name'],$full_flg_path);                        
                    $this->request->data['bannerImage'] = "banner/".$filename;
                } else {
                    $this->Flash->error(__('Banner Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'edit']);
                }
            } else {
                $this->request->data['bannerImage'] = $this->request->data['oldImg'];
            }
            $banners = $this->Banners->patchEntity($banners, $this->request->data);
            if ($this->Banners->save($banners)) {
                $this->Flash->success(__('Banners has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('Banners could not updated. Please, try again.'));
            }
        }
        $this->set(compact('banners'));
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
        $banners = $this->Banners->get($id);
        if ($this->Banners->delete($banners)) {
            $this->Flash->success(__('Banners has been deleted.'));
        }else {
            $this->Flash->error(__('Banners could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null){
        $id = base64_decode($id);
        $banner = $this->Banners->get($id);
        $this->set(compact('banner'));
    }
}
