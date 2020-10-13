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
class FaqsController extends AppController {
    
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

        $faqs = $this->Faqs->find('all')->order(['listOrder'=>'ASC'])->toArray();
        // print_r($faqs); exit;
        $this->set(compact('faqs'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $faq = $this->Faqs->newEntity();
        if ($this->request->is('post')) {
            if(empty($this->request->data['isActive'])){
                $this->request->data['isActive'] = '';
            }
        	// print_r($this->request->data); exit;
        	$faq = $this->Faqs->patchEntity($faq, $this->request->data);
        	if ($this->Faqs->save($faq)) {
        		$this->Flash->success(__('FAQ has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('FAQ could not added. Please, try again.'));
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
        $faq = $this->Faqs->get($id);
        if ($this->request->is(['post','put'])) {
            if(empty($this->request->data['isActive'])){
                $this->request->data['isActive'] = '';
            }
            
            $faq = $this->Faqs->patchEntity($faq, $this->request->data);
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('FAQ has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('FAQ could not updated. Please, try again.'));
            }
        }
        $this->set(compact('faq'));
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
        $faq = $this->Faqs->get($id);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('FAQ has been deleted.'));
        }else {
            $this->Flash->error(__('FAQ could not deleted. Please, try again.'));
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
        $faq = $this->Faqs->get($id);
        $this->set(compact('faq'));
    }

    /**
     * ajaxChangeOrder method
     *
     * change faq order
     * @return json
     */
    public function ajaxChangeOrder(){
        // print_r($this->request->data); exit;
        $data= [];
        $n=1;
        foreach ($this->request->data['data'] as $key => $value) {
            $faq = $this->Faqs->get($value);
            $faq = $this->Faqs->patchEntity($faq, ['list_order'=>$n]);
            $this->Faqs->save($faq);
            $n++;
        }
        $data['ack'] = 1;
        echo json_encode($data); exit;
    }
}
