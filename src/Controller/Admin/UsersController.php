<?php

namespace App\Controller\admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * UsersController controller
 *
 * This controller will render views from Template/Admin/Competitions
 *
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'forgotPassword', 'setPassword']);
    }

    public $paginate = [
        'limit' => 15
    ];
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Auth->logout();
        $this->viewBuilder()->layout('admin');
        $this->loadModel('ShoppingCarts');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                 //print_r($this->Auth->redirectUrl()); exit;
                 return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Your email or password is incorrect.');
            }
        }
    }

    /**
     * dashboard method
     *
     * @return void
     */
    public function dashboard() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');

        $users = $this->Users->find()->where(['isAdmin' => 0, 'isActive' => 1])->count();
        $date = date('Y-m-d H:i:s');
        $activeClass = 'dashboard';
        $this->set(compact('users', 'date','activeClass'));
    }

    /**
     * myaccount method
     * Here show admin account details and can update his details
     *
     * @return void
     */
    public function myaccount() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $id = $this->request->session()->read('Auth.Admin.id');
        $user = $this->Users->get($id);
        if ($this->request->is(['post','put'])) {
            $name=trim($this->request->data['name']);
            if (strpos($name, ' ') !== false) {
                $this->request->data['firstName']=explode(' ', $name)[0];
                $this->request->data['lastName']=explode(' ', $name)[1];
            }else{
                $this->request->data['firstName']=$name;
            }
            if($this->request->data['profilePicture']['name'] != '') {
                $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                $arr_ext = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arr_ext)) {
                    $uploadFolder = "userImg";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                    $this->request->data['profilePicture'] = "userImg/".$filename;
                } else {
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'myaccount']);
                } 
            } else {
                $this->request->data['profilePicture'] = $this->request->data['oldimg'];
            }


            //print_r($this->request->data); exit;
            unset($this->request->data['oldimg']);
            unset($this->request->data['name']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been updated Successfully.'));
                return $this->redirect(['action' => 'myaccount']);
            }
        }
        $this->set(compact('user'));
    }

    /**
     * change_password method
     * If admin want to change his password he can update his password
     *
     * @return void
     */
    public function change_password() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        if ($this->request->is('post')) {
            $userId = $this->request->session()->read('Auth.Admin.id');

            $user = $this->Users->get($userId);
            $oldPassword = $user['password'];
            $newPassword = $this->request->data['new_password'];
            $confirmPassword = $this->request->data['password'];
            $verify = password_verify($this->request->data['password'], $oldPassword);

            if ($newPassword != $confirmPassword) {
                $this->Flash->error(__('New password and confirm password does not match.'));
                return $this->redirect(['action'=>'change_password']);
            } elseif ($verify == 1) {
                $this->Flash->error(__('Old password and new password can not be same.'));
                return $this->redirect(['action'=>'change_password']);
            } else {
                $user = $this->Users->patchEntity($user, ['password'=>$this->request->data['password']]);
                $this->Users->save($user);
                $this->Flash->success(__('Password is Successfully updated.'));
                return $this->redirect(['action'=>'index']);
            }
        }
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout() {
        $this->Auth->logout();
        return $this->redirect("/admin");
    }

    /**
     * forgotPassword method
     *
     * User can send his comment to admin
     * @return json
     */
    public function forgotPassword() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        // $this->loadModel('EmailTemplates');
        $url = Router::url('/', true);
        if ($this->request->is('post')) {
            $email = $this->request->data['email'];
            $userExist = $this->Users->find()->where(['email'=>$email])->first();
            if ($userExist) {
                // $email_template = $this->EmailTemplates->get(1);
                $url = $url.'admin/users/setpassword/'.base64_encode($userExist['id']);
                // $message = str_replace(['[URL]'], [$url], $email_template['content']);
                $html = '<p>Hi, </p>
                        <p>Go to this link to create new password <a href="'.$url.'">Click Here</a></p>';
                $to = $email;
                $from = ['info@jembefund.org' => 'Jembe Fund'];
                $subject = 'Jembe Fund Forgot Password';
                $resArray = $this->sendMail($to, $from, $subject, $html);
                // pr($resArray);
                // echo $subject; exit();
                if($resArray['ack'] == 1){
                    $this->Flash->success(__('The link has been sent on your email. Please check in your inbox or in spam folder.'));
                    return $this->redirect(['action'=>'forgotPassword']);
                }
            } else {
                $this->Flash->error(__('Email does not exist.'));
                return $this->redirect(['action'=>'forgotPassword']);
            }
        }
    }

    /**
     * setpassword method
     * when user forgot his password then he set a new password through email link
     *
     * @return void
     */
    public function setpassword($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $userId = base64_decode($id);

        if ($this->request->is('post')) {
            $user = $this->Users->get($userId);
            $newPassword = $this->request->data['new_password'];
            $confirmPassword = $this->request->data['password'];

            if ($newPassword == "") {
                $this->Flash->error(__('New password can not be empty.'));
                return $this->redirect(['action'=>'setpassword', $id]);
            }elseif ($confirmPassword == "") {
                $this->Flash->error(__('Confirm password can not be empty.'));
                return $this->redirect(['action'=>'setpassword', $id]);
            }elseif ($newPassword != $confirmPassword) {
                $this->Flash->error(__('New password and confirm password does not match.'));
                return $this->redirect(['action'=>'setpassword', $id]);
            } else {
                $user = $this->Users->patchEntity($user, ['password'=>$this->request->data['password']]);
                $this->Users->save($user);
                $this->Flash->success(__('Password is Successfully updated.'));
                return $this->redirect('/admin');
            }
        }
    }

    public function customer_list() {
        $this->viewBuilder()->layout('admin');

        $customers = $this->Users->find()->where(['type'=>'C', 'isDeleted'=>0])->order(['id'=>'desc']);
        $customers = $this->paginate($customers)->toArray();

        $this->set(compact('customers'));
    }

    public function service_provider_list() {
        $this->viewBuilder()->layout('admin');

        $service_providers = $this->Users->find()->where(['type'=>'SP', 'isDeleted'=>0])->order(['id'=>'desc']);
        $service_providers = $this->paginate($service_providers)->toArray();

        $this->set(compact('service_providers'));
    }

    public function subadmin_list() {
        $this->viewBuilder()->layout('admin');

        $subadmin_list = $this->Users->find()->where(['type'=>'SA', 'isDeleted'=>0])->order(['id'=>'desc']);
        $subadmin_list = $this->paginate($subadmin_list)->toArray();

        $this->set(compact('subadmin_list'));
    }

    public function add_subadmin() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('LeftmenuList');
        $leftmenu_list = $this->LeftmenuList->find()->where(['status'=>'active']);

        $sub_admin = $this->Users->newEntity();
        if ($this->request->is('post')) {
             
            $duplicate = $this->Users->find()->where(['email'=>$this->request->data['email'], 'isActive'=>1, 'isDeleted'=>0])->first();
            if(empty($duplicate)){
                $name=trim($this->request->data['name']);
                if (strpos($name, ' ') !== false) {
                    $this->request->data['firstName']=explode(' ', $name)[0];
                    $this->request->data['lastName']=explode(' ', $name)[1];
                }else{
                    $this->request->data['firstName']=$name;
                }
                if($this->request->data['profilePicture']['name'] != '') {
                    $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                    $arr_ext = array('jpg', 'jpeg', 'png');
                    $ext = $pathpart['extension'];
                    if (in_array($ext, $arr_ext)) {
                        $uploadFolder = "userImg";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid().".".$ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                        $this->request->data['profilePicture'] = "userImg/".$filename;
                    } else {
                        $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                        return $this->redirect(['action'=>'add_subadmin']);
                    } 
                } else {
                    $this->request->data['profilePicture']='';
                }

                $leftmenuArr = $this->request->data['leftmenuid'];
                $leftmenuString = '';
                if(count($leftmenuArr)>0){
                    for ($i=0; $i <count($leftmenuArr) ; $i++) { 
                        if($leftmenuString){
                            $leftmenuString = $leftmenuString.','.$leftmenuArr[$i];
                        } else {
                            $leftmenuString = $leftmenuArr[$i];
                        }
                    }
                }

                $this->request->data['subadmin_access_ids'] = $leftmenuString;
                $this->request->data['isAdmin'] = 1;
            
                // echo '<pre>'; print_r($this->request->data);
                // exit();
                
                $sub_admin = $this->Users->patchEntity($sub_admin, $this->request->data);
                if($this->Users->save($sub_admin)){
                    $this->Flash->success(__('Sub Admin has been added successfully.'));
                    return $this->redirect(['action'=>'subadmin_list']);
                }else{
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'add_subadmin']);
                }
            }else{
                $this->Flash->success(__('Email already in use please use another.'));
                return $this->redirect(['action'=>'add_subadmin']);
            }
        } 

        $this->set(compact('leftmenu_list'));
    }

    public function add_customer() {
        $this->viewBuilder()->layout('admin');
        
        if ($this->request->is('post')) {
             
            $duplicate = $this->Users->find()->where(['email'=>$this->request->data['email'], 'isActive'=>1, 'isDeleted'=>0])->first();
            if(empty($duplicate)){
                $name=trim($this->request->data['name']);
                if (strpos($name, ' ') !== false) {
                    $this->request->data['firstName']=explode(' ', $name)[0];
                    $this->request->data['lastName']=explode(' ', $name)[1];
                }else{
                    $this->request->data['firstName']=$name;
                }
                if($this->request->data['profilePicture']['name'] != '') {
                    $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                    $arr_ext = array('jpg', 'jpeg', 'png');
                    $ext = $pathpart['extension'];
                    if (in_array($ext, $arr_ext)) {
                        $uploadFolder = "userImg";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid().".".$ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                        $this->request->data['profilePicture'] = "userImg/".$filename;
                    } else {
                        $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                        return $this->redirect(['action'=>'add_customer']);
                    } 
                }
                $customer = $this->Users->newEntity();
                $customer = $this->Users->patchEntity($customer, $this->request->data);
                if ($this->Users->save($customer)) {
                    $this->Flash->success(__('Customer has been added successfully.'));
                    return $this->redirect(['action'=>'customer_list']);
                } else {
                    $this->Flash->error(__('Customer could not added. Please, try again.'));
                }
            }else{
                $this->Flash->success(__('Email already in use please use another.'));
                return $this->redirect(['action'=>'add_customer']);
            }
        }
    }

    public function add_service_provider() {
        $this->viewBuilder()->layout('admin');
        $service_provider = $this->Users->newEntity();
        if ($this->request->is('post')) {
             
            $duplicate = $this->Users->find()->where(['email'=>$this->request->data['email'], 'isActive'=>1, 'isDeleted'=>0])->first();
            if(empty($duplicate)){
                $name=trim($this->request->data['name']);
                if (strpos($name, ' ') !== false) {
                    $this->request->data['firstName']=explode(' ', $name)[0];
                    $this->request->data['lastName']=explode(' ', $name)[1];
                }else{
                    $this->request->data['firstName']=$name;
                }
                if($this->request->data['profilePicture']['name'] != '') {
                    $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                    $arr_ext = array('jpg', 'jpeg', 'png');
                    $ext = $pathpart['extension'];
                    if (in_array($ext, $arr_ext)) {
                        $uploadFolder = "userImg";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid().".".$ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                        $this->request->data['profilePicture'] = "userImg/".$filename;
                    } else {
                        $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                        return $this->redirect(['action'=>'add_service_provider']);
                    } 
                } else {
                    $this->request->data['profilePicture']='';
                }
                
                $service_provider = $this->Users->patchEntity($service_provider, $this->request->data);
                if($this->Users->save($service_provider)){
                    $this->Flash->success(__('Service Provider has been added successfully.'));
                    return $this->redirect(['action'=>'service_provider_list']);
                }else{
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'add_service_provider']);
                }
            }else{
                $this->Flash->success(__('Email already in use please use another.'));
                return $this->redirect(['action'=>'add_service_provider']);
            }
        }
    }

    public function delete($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $user = $this->Users->get($id);
        $status=array();
        $status['isDeleted']=1;
        $user = $this->Users->patchEntity($user, $status);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Deleted successfully.'));
            return $this->redirect( Router::url( $this->referer(), true ) );
        } else {
            $this->Flash->error(__('Can not be deleted. Please, try again.'));
        }
        return $this->redirect( Router::url( $this->referer(), true ) );
    }

    public function status($id = null) {
        $this->viewBuilder()->layout('admin');
        $id = base64_decode($id);
        $user = $this->Users->get($id);
        $status=array();
        $status['isActive']=$user['isActive']==1?0:1;
        $user = $this->Users->patchEntity($user, $status);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Status has been changed successfully.'));
            return $this->redirect( Router::url( $this->referer(), true ) );
        } else {
            $this->Flash->error(__('Status can not be change. Please, try again.'));
        }
        return $this->redirect( Router::url( $this->referer(), true ) );
    }

    public function customer_view($id = null){
        $id = base64_decode($id);
        $customer = $this->Users->get($id);
        $this->set(compact('customer'));
    }

    public function service_provider_view($id = null){
        $id = base64_decode($id);
        $service_provider = $this->Users->get($id);
        $this->set(compact('service_provider'));
    }

    public function subadmin_view($id = null){
        $id = base64_decode($id);
        $subadmin = $this->Users->get($id);
        $this->set(compact('subadmin'));
    }

    public function edit_customer($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $id = base64_decode($id);
        $user = $this->Users->get($id);
        if ($this->request->is(['post','put'])) {
            $name=trim($this->request->data['name']);
            if (strpos($name, ' ') !== false) {
                $this->request->data['firstName']=explode(' ', $name)[0];
                $this->request->data['lastName']=explode(' ', $name)[1];
            }else{
                $this->request->data['firstName']=$name;
            }
            if($this->request->data['profilePicture']['name'] != '') {
                $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                $arr_ext = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arr_ext)) {
                    $uploadFolder = "userImg";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                    $this->request->data['profilePicture'] = "userImg/".$filename;
                } else {
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'myaccount']);
                } 
            } else {
                $this->request->data['profilePicture'] = $this->request->data['oldimg'];
            }
            unset($this->request->data['oldimg']);
            unset($this->request->data['name']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Customer has been updated Successfully.'));
                return $this->redirect(['action' => 'customer_list']);
            }
        }
        $this->set(compact('user'));
    }

    public function edit_service_provider($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $id = base64_decode($id);
        $user = $this->Users->get($id);
        if ($this->request->is(['post','put'])) {
            $name=trim($this->request->data['name']);
            if (strpos($name, ' ') !== false) {
                $this->request->data['firstName']=explode(' ', $name)[0];
                $this->request->data['lastName']=explode(' ', $name)[1];
            }else{
                $this->request->data['firstName']=$name;
            }
            if($this->request->data['profilePicture']['name'] != '') {
                $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                $arr_ext = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arr_ext)) {
                    $uploadFolder = "userImg";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                    $this->request->data['profilePicture'] = "userImg/".$filename;
                } else {
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'myaccount']);
                } 
            } else {
                $this->request->data['profilePicture'] = $this->request->data['oldimg'];
            }
            unset($this->request->data['oldimg']);
            unset($this->request->data['name']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Service Provider has been updated Successfully.'));
                return $this->redirect(['action' => 'service_provider_list']);
            }
        }
        $this->set(compact('user'));
    }

    public function edit_subadmin($id = null) {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Users');
        $this->loadModel('LeftmenuList');
        $leftmenu_list = $this->LeftmenuList->find()->where(['status'=>'active']);

        $id = base64_decode($id);
        $user = $this->Users->get($id);
        if ($this->request->is(['post','put'])) {
            $name=trim($this->request->data['name']);
            if (strpos($name, ' ') !== false) {
                $this->request->data['firstName']=explode(' ', $name)[0];
                $this->request->data['lastName']=explode(' ', $name)[1];
            }else{
                $this->request->data['firstName']=$name;
            }
            if($this->request->data['profilePicture']['name'] != '') {
                $pathpart=pathinfo($this->request->data['profilePicture']['name']);
                $arr_ext = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arr_ext)) {
                    $uploadFolder = "userImg";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['profilePicture']['tmp_name'],$full_flg_path);                        
                    $this->request->data['profilePicture'] = "userImg/".$filename;
                } else {
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'subadmin_list']);
                } 
            } else {
                $this->request->data['profilePicture'] = $this->request->data['oldimg'];
            }

            $leftmenuArr = $this->request->data['leftmenuid'];
            $leftmenuString = '';
            if(count($leftmenuArr)>0){
                for ($i=0; $i <count($leftmenuArr) ; $i++) { 
                    if($leftmenuString){
                        $leftmenuString = $leftmenuString.','.$leftmenuArr[$i];
                    } else {
                        $leftmenuString = $leftmenuArr[$i];
                    }
                }
            }

            $this->request->data['subadmin_access_ids'] = $leftmenuString;

            unset($this->request->data['oldimg']);
            unset($this->request->data['name']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Sub Admin has been updated Successfully.'));
                return $this->redirect(['action' => 'subadmin_list']);
            }
        }
        $this->set(compact('user','leftmenu_list'));
    }





}
