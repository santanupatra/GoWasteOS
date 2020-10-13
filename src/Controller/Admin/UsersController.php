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
                // print_r($user); exit;
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
        $this->set(compact('users', 'date'));
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
        // print_r($user); exit;
        if ($this->request->is(['post','put'])) {
            if($this->request->data['userImage']['name'] != '') {
                $pathpart=pathinfo($this->request->data['userImage']['name']);
                $arr_ext = array('jpg', 'jpeg', 'png');
                $ext = $pathpart['extension'];
                if (in_array($ext, $arr_ext)) {
                    $uploadFolder = "userImg";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid().".".$ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['userImage']['tmp_name'],$full_flg_path);                        
                    $this->request->data['userImage'] = "userImg/".$filename;
                } else {
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                    return $this->redirect(['action'=>'myaccount']);
                } 
            } else {
                $this->request->data['userImage'] = $this->request->data['oldimg'];
            }
            unset($this->request->data['oldimg']);
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

    public function contactList() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('ContactUs');
        $results = $this->ContactUs->find()->where(['isActive' => 1])->order(['id'=>'DESC']);
        $this->set(compact('results'));
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
                if($resArray['ack'] == 1){
                    $this->Flash->success(__('The link has been sent on your email. Please check in your inbox or in spam folder.'));
                    return $this->redirect(['action'=>'forgotPassword']);
                }
            } else {
                $this->Flash->error(__('Email not exist.'));
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
}
