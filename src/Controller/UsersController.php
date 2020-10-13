<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\Session\DatabaseSession;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['ajaxUserSignup','login']);
    }
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function ajaxUserSignup(){
        $data = [];
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
        	// print_r($this->request->data); exit;
        	$user = $this->Users->patchEntity($user, $this->request->data);
        	if ($this->Users->save($user)) {
        		$data['ack']=1;
        		$data['msg']="You have successfully signup";
        	} else {
        		$data['ack']=0;
        		$data['msg']="Something went wrong!!";
        	}
        }
        echo json_encode($data); exit;
    }

    /**
     * login method
     *
     * @return void
     */
    public function login() {
        $this->Auth->logout();
        if ($this->request->is('post')) {
            $userExist = $this->Users->find()->where(['email' => $this->request->data['email']])->first();
            if ($userExist) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $userid = $this->request->session()->read('Auth.User.id');
                    $this->Flash->success('You have successfully login.');
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error('Your email or password is incorrect.');
                }
            } else {
                $this->Flash->error('Your have enter incorrect email.');
                return $this->redirect(['controller'=>'Pages','action'=>'home']);
            }
        }
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout() {
        $this->request->session()->destroy();
        $this->Auth->logout();
        return $this->redirect("/");
    }

    /**
     * profile method
     *
     * @return void
     */
    public function profile() {
        $userid = $this->request->session()->read('Auth.User.id');
        $userDetails = $this->Users->get($userid);
        if ($this->request->is(['post','put'])) {
            $userDetails = $this->Users->patchEntity($userDetails, $this->request->data);
            if ($this->Users->save($userDetails)) {
                $this->Flash->success(__('user data has been updated successfully.'));
                return $this->redirect(['action'=>'profile']);
            } else {
                $this->Flash->error(__('User could not updated. Please, try again.'));
            }
        }
        $this->set(compact('userDetails', 'userid'));
    }

    /**
     * logout method
     *
     * @return void
     */
    public function query() {
        
    }
}
