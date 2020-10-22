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
class AccountsController extends AppController {
    
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
    public function index($id=null) {
        $this->viewBuilder()->layout('admin');
        $id=base64_decode($id);
        $accounts = $this->Accounts->find()->where(['Accounts.user_id' => $id])
        ->order(['Accounts.id' => 'DESC']);
        $this->set('accounts', $this->paginate($accounts));
    }

    /**
     * add method
     *
     * @return void
     */
    // public function add() {
    //     $this->viewBuilder()->layout('admin');
    //     $this->loadModel('Users');
    //     $review = $this->Reviews->newEntity();
    //     if ($this->request->is('post')) {
    //         $review = $this->Reviews->patchEntity($review, $this->request->data);
    //         $result = $this->Reviews->save($review);
    //     	if ($result) {
    //             $reviewsAll = $this->Reviews->find()->where(['is_active'=>1, 'to_id'=>$this->request->data['to_id']])->toArray();
    //             $avgRating=0;
    //             $reviewCount=0;
    //             if(!empty($reviewsAll)){
    //                 foreach ($reviewsAll as $key => $value) {
    //                     $reviewCount+=$value['rating'];
    //                 }
    //                 $avgRating=$reviewCount/count($reviewsAll);
    //             }

    //             $userEdit = $this->Users->get($this->request->data['to_id']);
    //             $status=array();
    //             $status['rating']=$avgRating;
    //             $userEdit = $this->Users->patchEntity($userEdit, $status);
    //             if($this->Users->save($userEdit)){
    //                 $this->Flash->success(__('Rating has been added successfully.'));
    //                 return $this->redirect(['action'=>'index']);
    //             }        
                
    //     	} else {
    //     		$this->Flash->error(__('Rating could not added. Please, try again.'));
    //     	}
    //     }

    //     $users = $this->Users->find()->where(['isActive'=>1, 'isAdmin'=>0])->order(['id'=>'DESC'])->toArray();
    //     $this->set(compact('users'));
    // }


    // /**
    //  * delete method
    //  *
    //  * @param string $id
    //  * @return void
    //  */
    public function delete($id = null, $user_id=null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $id = base64_decode($id);
        $account = $this->Accounts->get($id);
        if ($this->Accounts->delete($account)) {
            $this->Flash->success(__('Acount information has been deleted.'));
            return $this->redirect(['action'=>'index/'.$user_id]);           
        }else {
            $this->Flash->error(__('Acount information could not deleted. Please, try again.'));
        }
        return $this->redirect(['action'=>'index']);
    }

    public function view($id = null, $user_id=null){
        $this->loadModel('Users');
        $id = base64_decode($id);
        $user_id = base64_decode($user_id);
        $account = $this->Accounts->find()->where(['Accounts.id'=>$id])->contain(['Users'])->first();
        $debitAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$user_id, 'transaction_type'=>'D'])->toArray();
        $creditAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$user_id, 'transaction_type'=>'C'])->toArray();
        $debit=0;
        $credit=0;
        $total=0;
        if(!empty($debitAll)){
            foreach ($debitAll as $key => $value) {
                $debit+=$value['total_amount_transferred'];
            }
        }
        if(!empty($creditAll)){
            foreach ($creditAll as $key => $value) {
                $credit+=$value['total_amount_transferred'];
            }
        }
        if($debit>$credit){
            $total=$debit-$credit;
        }else{
            $total=$credit-$debit;
        }
        $this->set(compact('account', 'total'));
    }
}
