<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * ProductsController controller
 *
 * This controller will render views from Template/Admin/Products/
 *
 */
class ProductsController extends AppController {
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect('/admin');
        }
    }

    public $paginate = [
        'Products' => [
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

        $products = $this->Products->find()->order(['id'=>'desc']);
        $products = $this->paginate($products)->toArray();

        // print_r($Products); exit;
        $this->set(compact('products'));
        // $this->set('Products', $this->paginate($Products));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('ProductImages');
        
        if ($this->request->is('post')) {
            // print_r($this->request->data); exit;
            $product = $this->Products->newEntity();
        	$product = $this->Products->patchEntity($product, $this->request->data);
            $result = $this->Products->save($product);
            if(!empty($this->request->data['productImage'][0]['name'])) {
                foreach($this->request->data['productImage'] as $key => $img) {
                    $pathpart=pathinfo($img['name']);
                    $arrExt = array('jpg', 'jpeg', 'png','JPEG','webp');
                    $ext = $pathpart['extension'];
                    if (in_array($ext, $arrExt)) {
                        $uploadFolder = "productImg";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = $key.time().".".$ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($img['tmp_name'],$full_flg_path); 
                        $imgPath = "productImg/".$filename;
                        $imgData = $this->ProductImages->newEntity();
                        $imgData = $this->ProductImages->patchEntity($imgData, ['productId'=>$result->id, 'originalpath'=>$imgPath]);
                        $this->ProductImages->save($imgData);
                    }
                } 
            }
            $this->Flash->success(__('product has been added successfully.'));
            return $this->redirect(['action'=>'index']);
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
        $this->loadModel('ProductImages');

        $id = base64_decode($id);
        $product = $this->Products->get($id);
        if ($this->request->is(['post','put'])) {
            // print_r($this->request->data); exit;
            $product = $this->Products->patchEntity($product, $this->request->data);
            $result = $this->Products->save($product);
            if(!empty($this->request->data['productImage'][0]['name'])) {
                $getImgs = $this->ProductImages->find()->where(['productId'=>$id])->toArray();
                foreach($getImgs as $image){
                    $data = $this->ProductImages->get($image['id']);
                    $this->ProductImages->delete($data);
                    $imagePath = $data['originalpath'];
                    $uploadPath = WWW_ROOT . $imagePath;
                    unlink($uploadPath); // correct
                }
                foreach($this->request->data['productImage'] as $key => $img) {
                    $pathpart=pathinfo($img['name']);
                    $arrExt = array('jpg', 'jpeg', 'png','JPEG','webp');
                    $ext = $pathpart['extension'];
                    if (in_array($ext, $arrExt)) {
                        $uploadFolder = "productImg";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = $key.time().".".$ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($img['tmp_name'],$full_flg_path); 
                        $imgPath = "productImg/".$filename;
                        $imgData = $this->ProductImages->newEntity();
                        $imgData = $this->ProductImages->patchEntity($imgData, ['productId'=>$id, 'originalpath'=>$imgPath]);
                        $this->ProductImages->save($imgData);
                    }
                } 
            }
            $this->Flash->success(__('product has been updated successfully.'));
            return $this->redirect(['action'=>'index']);
        }
        $this->set(compact('product','ptypes','locations','attributes', 'levels', 'locationId'));
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
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $img = $product['productImage'];
            $uploadPath = WWW_ROOT . $img;
            unlink($uploadPath); // correct
            $this->Flash->success(__('product has been deleted.'));
        }else {
            $this->Flash->error(__('product could not deleted. Please, try again.'));
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
        $product = $this->Products->get($id, [
            'contain' => ['ProductImages']
            ]);
        // print_r($product); exit;
        $this->set(compact('product'));
    }
}
