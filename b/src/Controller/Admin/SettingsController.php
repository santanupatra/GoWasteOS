<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Settings controller
 *
 * This controller will render views from Template/Admin/Settings/
 *
 */
class SettingsController extends AppController {
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect('/admin');
        }
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');
        $id=1;
        $setting = $this->Settings->get($id);
        if ($this->request->is(['post', 'put'])) {
        	$setting = $this->Settings->patchEntity($setting, $this->request->data);
        	if ($this->Settings->save($setting)) {
        		$this->Flash->success(__('Setting details successfully updated.'));
        	} else {
        		$this->Flash->error(__('Setting details could not update. Please, try again.'));
        	}
        	return $this->redirect(array('action'=>'index'));
        }
        $this->set(compact('setting'));
    }

    /**
     * logo method
     *
     * @return void
     */
    public function logo() {
        $this->viewBuilder()->layout('admin');
        $id=1;
        $setting = $this->Settings->get($id);
        if ($this->request->is(['post', 'put'])) {
        	if($this->request->data['logo']['name'] != '') {
                $pathpart=pathinfo($this->request->data['logo']['name']);
                $arrExt = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $uploadFolder = "siteLogo/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['logo']['tmp_name'],$full_flg_path);                        
                    $this->request->data['logo'] = "siteLogo/".$filename;
                } else {
                    $this->Flash->error(__('Logo Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'logo']);
                }
            } else {
                $this->request->data['logo'] = $this->request->data['oldlogo'];
            }
            if($this->request->data['favIcon']['name'] != '') {
                $pathpart=pathinfo($this->request->data['favIcon']['name']);
                $arrExt = array('jpg', 'jpeg', 'png', 'ico');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arrExt)) {
                    $favFolder = "siteLogo/";
                    $favPath = WWW_ROOT . $favFolder;
                    $favFileName = uniqid().".".$ext;
                    $fav_full_flg_path = $favPath . '/' . $favFileName;
                    move_uploaded_file($this->request->data['favIcon']['tmp_name'],$fav_full_flg_path);                        
                    $this->request->data['favIcon'] = "siteLogo/".$favFileName;
                } else {
                    $this->Flash->error(__('Fav Icon Only jpg,jpeg,png Files.'));
                    return $this->redirect(['action'=>'logo']);
                }
            } else {
                $this->request->data['favIcon'] = $this->request->data['oldfav'];
            }
        	$setting = $this->Settings->patchEntity($setting, $this->request->data);
        	if ($this->Settings->save($setting)) {
        		$this->Flash->success(__('Logo successfully updated.'));
        	} else {
        		$this->Flash->error(__('Logo could not update. Please, try again.'));
        	}
        	
        }
        // print_r($setting); exit;
        $this->set(compact('setting'));
    }

    /**
     * donorList method
     *
     * @return void
     */
    public function donorList() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Transactions');
        $transactions = $this->Transactions->find()->contain(['Users'])->order(['Transactions.id'=>'desc']);
        $transactions = $this->paginate($transactions)->toArray();

        // print_r($transactions); exit;
        $this->set(compact('transactions'));
    }
}
