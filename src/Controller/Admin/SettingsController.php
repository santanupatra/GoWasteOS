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


    /**
     * donorList method
     *
     * @return void
     */
}
