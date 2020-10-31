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
        'limit' => 9
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
    public function customer($id=null) {
        $this->viewBuilder()->layout('admin');
        $id=base64_decode($id);
        $accounts = $this->Accounts->find()->where(['Accounts.user_type' => 'C'])->contain(['Users'])->group(['Accounts.user_id'])
        ->order(['Accounts.id' => 'DESC']);
        $debits=array();
        $credits=array();
        $totals=array();
        $user=array();
        foreach ($this->paginate($accounts) as $key => $value) {
            array_push($user,$value['user_id']);
        }
        foreach ($user as $key => $value) {
            $debitAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$value, 'transaction_type'=>'D'])->toArray();
            $creditAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$value, 'transaction_type'=>'C'])->toArray();
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

            array_push($debits,$debit);
            array_push($credits,$credit);
            array_push($totals,$total);

        }
        $this->set('accounts', $this->paginate($accounts));
        $this->set(compact('debits', 'credits', 'totals'));
    }
    public function service_provider($id=null) {
        $this->viewBuilder()->layout('admin');
        $id=base64_decode($id);
        $accounts = $this->Accounts->find()->where(['Accounts.user_type' => 'SP'])->contain(['Users'])->group(['Accounts.user_id'])
        ->order(['Accounts.id' => 'DESC']);
        
        $debits=array();
        $credits=array();
        $totals=array();
        $user=array();
        foreach ($this->paginate($accounts) as $key => $value) {
            array_push($user,$value['user_id']);
        }
        foreach ($user as $key => $value) {
            $debitAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$value, 'transaction_type'=>'D'])->toArray();
            $creditAll = $this->Accounts->find()->where(['is_active'=>1, 'user_id'=>$value, 'transaction_type'=>'C'])->toArray();
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

            array_push($debits,$debit);
            array_push($credits,$credit);
            array_push($totals,$total);

        }
        $this->set('accounts', $this->paginate($accounts));
        $this->set(compact('debits', 'credits', 'totals'));
    }


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
