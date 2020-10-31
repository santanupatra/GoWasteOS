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
class ReviewsController extends AppController {
    
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
        $rating = @$this->request->query['rating'];
        if(@$rating!=''){
            $reviews = $this->Reviews->find()->where(['Reviews.rating'=>$rating, 'Reviews.is_reviewer_customer'=>1])->contain(['Reviewds', 'Reviewers', 'Bookings'])->order(['Reviews.id' => 'DESC']);
            $this->set(compact('rating'));
        } else {
            $reviews = $this->Reviews->find()->where(['Reviews.is_reviewer_customer'=>1])->contain(['Reviewds', 'Reviewers','Bookings'])->order(['Reviews.id' => 'DESC']);
        }  
        $this->set('reviews', $this->paginate($reviews));
    }

    public function service_provider() {
        $this->viewBuilder()->layout('admin');
        $rating = @$this->request->query['rating'];
        if(@$rating!=''){
            $reviews = $this->Reviews->find()->where(['Reviews.rating'=>$rating, 'Reviews.is_reviewer_customer'=>0])->contain(['Reviewds', 'Reviewers', 'Bookings'])->order(['Reviews.id' => 'DESC']);
            $this->set(compact('rating'));
        } else {
            $reviews = $this->Reviews->find()->where(['Reviews.is_reviewer_customer'=>0])->contain(['Reviewds', 'Reviewers','Bookings'])->order(['Reviews.id' => 'DESC']);
        }      
        $this->set('reviews', $this->paginate($reviews));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $this->loadModel('Bookings');
        $review = $this->Reviews->newEntity();
        if ($this->request->is('post')) {
            $duplicate = $this->Reviews->find()->where(['from_id'=>$this->request->data['from_id'], 'booking_id'=>$this->request->data['booking_id']])->first();
            if(empty($duplicate)){
                $is_reviewer_customer = $this->Users->find()->where(['id'=>$this->request->data['from_id']])->first();
                if($is_reviewer_customer['type']=="C"){
                    $this->request->data['is_reviewer_customer']=1;
                }else{
                    $this->request->data['is_reviewer_customer']=0;
                }
                $review = $this->Reviews->patchEntity($review, $this->request->data);
                $result = $this->Reviews->save($review);
                if ($result) {
                    $reviewsAll = $this->Reviews->find()->where(['is_active'=>1, 'to_id'=>$this->request->data['to_id']])->toArray();
                    $avgRating=0;
                    $reviewCount=0;
                    if(!empty($reviewsAll)){
                        foreach ($reviewsAll as $key => $value) {
                            $reviewCount+=$value['rating'];
                        }
                        $avgRating=$reviewCount/count($reviewsAll);
                    }
    
                    $userEdit = $this->Users->get($this->request->data['to_id']);
                    $status=array();
                    $status['rating']=$avgRating;
                    $userEdit = $this->Users->patchEntity($userEdit, $status);
                    if($this->Users->save($userEdit)){
                        $this->Flash->success(__('Rating has been added successfully.'));
                        return $this->redirect(['action'=>'index']);
                    }        
                    
                } else {
                    $this->Flash->error(__('Rating could not added. Please, try again.'));
                }
            }else{
                $this->Flash->error(__('Review already given against this booking.'));
            }
        }

        $users = $this->Users->find()->where(['isActive'=>1, 'isAdmin'=>0])->order(['id'=>'DESC'])->toArray();
        $bookings = $this->Bookings->find()->where(['is_active'=>1])->order(['id'=>'DESC'])->toArray();
        $this->set(compact('users', 'bookings'));
    }


    // /**
    //  * delete method
    //  *
    //  * @param string $id
    //  * @return void
    //  */
    public function delete($id = null, $to_id=null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $id = base64_decode($id);
        $to_id = base64_decode($to_id);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $reviewsAll = $this->Reviews->find()->where(['is_active'=>1, 'to_id'=>$to_id])->toArray();
            $avgRating=0;
            $reviewCount=0;
            if(!empty($reviewsAll)){
                foreach ($reviewsAll as $key => $value) {
                    $reviewCount+=$value['rating'];
                }
                $avgRating=$reviewCount/count($reviewsAll);
            }

            $userEdit = $this->Users->get($to_id);
            $status=array();
            $status['rating']=$avgRating;
            $userEdit = $this->Users->patchEntity($userEdit, $status);
            if($this->Users->save($userEdit)){
                $this->Flash->success(__('Review has been deleted.'));
                return $this->redirect(['action'=>'index']);
            }
           
        }else {
            $this->Flash->error(__('Review could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function view($id = null){
        $this->loadModel('Users');
        $id = base64_decode($id);
        $review = $this->Reviews->find()->where(['Reviews.id'=>$id])->contain(['Reviewds', 'Reviewers','Bookings'])->first();
        $this->set(compact('review'));
    }
}
