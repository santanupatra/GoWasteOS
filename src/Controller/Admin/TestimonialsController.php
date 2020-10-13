<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * TestimonialsController controller
 *
 * This controller will render views from Template/Admin/Testimonials/
 *
 */
class TestimonialsController extends AppController {
    
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

        $testimonials = $this->Testimonials->find('all')->order(['id'=>'DESC'])->toArray();
        // print_r($Testimonials); exit;
        $this->set(compact('testimonials'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $testimonial = $this->Testimonials->newEntity();
        if ($this->request->is('post')) {
            
        	// print_r($this->request->data); exit;
        	$testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->data);
        	if ($this->Testimonials->save($testimonial)) {
        		$this->Flash->success(__('Testimonial has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('Testimonial could not added. Please, try again.'));
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
        $testimonial = $this->Testimonials->get($id);
        if ($this->request->is(['post','put'])) {
            if($this->request->data['isActive']){
                $this->request->data['isActive'] = 1;
            }
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->data);
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('testimonial has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('testimonial could not updated. Please, try again.'));
            }
        }
        $this->set(compact('testimonial'));
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
        $testimonial = $this->Testimonials->get($id);
        if ($this->Testimonials->delete($testimonial)) {
            $this->Flash->success(__('Testimonial has been deleted.'));
        }else {
            $this->Flash->error(__('Testimonial could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }
}
