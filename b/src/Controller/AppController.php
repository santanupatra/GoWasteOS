<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Event\EventDispatcher;
use Cake\Mailer\Email;

/**
 * App Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    /* Sandbox details  */
    public $paypayUsername = '';  
    public $paypalPass = '';  
    public $paypalSignature = '';
    
    public function initialize(){
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Paginator');

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->viewBuilder()->layout('admin');
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'userModel' => 'Users',
                        'scope' =>['Users.isAdmin' => 1]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'dashboard'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'index',
                ],
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'index'
                ],
                'storage' => [
                    'className' => 'Session',
                    'key' => 'Auth.Admin'
                ]
            ]);
            $this->Auth->allow(['index']);
            // pr($this->Auth); exit;
        } else {
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'userModel' => 'Users',
                        'scope' =>['Users.isActive' => 1]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'Pages',
                    'action' => 'home'
                ],
                'logoutRedirect' => [
                    'controller' => 'Pages',
                    'action' => 'home',
                ],
                'loginAction' => [
                    'controller' => 'Pages',
                    'action' => 'home'
                ],
                'storage' => [
                    'className' => 'Session',
                    'key' => 'Auth.User'
                ]
            ]);
            // pr($this->Auth); exit;
        }
    }

    /**
     * beforeRender method
     *
     * Called before the view is rendered.
     */
    public function beforeRender(Event $event) {
        $this->loadModel('Users');
        $this->loadModel('Banners');
        $this->loadModel('Settings');
        $this->loadModel('Projects');
        $cartCount='';
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            if ($this->request->session()->check('Auth.Admin')) {
                $adminuserId = $this->request->session()->read('Auth.Admin.id');
                $admin_details = $this->Users->find()->where(['Users.id' => $adminuserId])->first()->toArray();
                // pr($admin_details); exit;
                $this->set(compact('adminuserId','admin_details'));
            }
        } else {
            $userid = $this->request->session()->read('Auth.User.id');
            if (isset($userid) && $userid != '') {
                $userDetails = $this->Users->get($userid);
                $this->set(compact('userDetails', 'userid'));
            }
        }
        $id=1;
        $setting = $this->Settings->get($id);
        $disclaimer = $this->Banners->get(5);
        $footer = $this->Banners->get(6);
        $this->set(compact('setting','disclaimer','footer'));
    }

    /**
     * sendMail method
     *
     * @return array
     */
    public function sendMail($to, $from, $subject, $message){
        $mail_To = $to; 
        // $mail_To = 'souravmaity133@gmail.com';
        $mail_CC = ''; 
        $mail_subject = $subject;
        $mail_body = $message;
        $email = new Email('default');
        if($email->emailFormat('html')
                ->from($from)
                ->to($mail_To)
                ->subject($mail_subject)
                ->send($mail_body)) {
            $response = ["ack" => 1];
            return $response;
        }
    }
}
