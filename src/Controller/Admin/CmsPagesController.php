<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * CmsPagesController controller
 *
 * This controller will render views from Template/Admin/CmsPages/
 *
 */
class CmsPagesController extends AppController {
    
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

        $cmspages = $this->CmsPages->find()->order(['id' => 'DESC']);;
        // print_r($cmspages); exit;
        $this->set('cmspages', $this->paginate($cmspages));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        
        $cmspage = $this->CmsPages->newEntity();
        if ($this->request->is('post')) {
        	// print_r($this->request->data); exit;
        	$cmspage = $this->CmsPages->patchEntity($cmspage, $this->request->data);
        	if ($this->CmsPages->save($cmspage)) {
        		$this->Flash->success(__('Cms Page has been added successfully.'));
                return $this->redirect(['action'=>'index']);
        	} else {
        		$this->Flash->error(__('Cms Page could not added. Please, try again.'));
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
        $cmspages = $this->CmsPages->get($id);
        if ($this->request->is(['post','put'])) {
            if(empty($this->request->data['status'])){
                $this->request->data['status'] = '';
            }
            
            $cmspages = $this->CmsPages->patchEntity($cmspages, $this->request->data);
            if ($this->CmsPages->save($cmspages)) {
                $this->Flash->success(__('CMS Page has been updated successfully.'));
                return $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error(__('CMS Page could not updated. Please, try again.'));
            }
        }
        $this->set(compact('cmspages'));
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
        $cmspages = $this->CmsPages->get($id);
        if ($this->CmsPages->delete($cmspages)) {
            $this->Flash->success(__('CMS Page has been deleted.'));
        }else {
            $this->Flash->error(__('CMS Page could not deleted. Please, try again.'));
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
        $cmspage = $this->CmsPages->get($id);
        $this->set(compact('cmspage'));
    }
}
