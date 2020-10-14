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
            'limit' => 20
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
        	// print_r($this->request->data); exit;
        	$city = $this->Cities->patchEntity($city, $this->request->data);
        	if ($this->Cities->save($city)) {
        		$this->Flash->success(__('City has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('City could not added. Please, try again.'));
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
        $id = base64_decode($id);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('City has been deleted.'));
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
