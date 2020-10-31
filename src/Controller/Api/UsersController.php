<?php
namespace App\Controller\Api;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['token','register','forgotpassword']);
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(event $event) { //if you dont have this beforeFilter already
        if ($this->request->is('options')) {
            return $this->response;
        }
    }
    
    public function add()
    {
        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => JWT::encode(
                        [
                            'sub' => $event->subject->entity->id,
                            'exp' =>  time() + 604800
                        ],
                    Security::salt())
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }
    
    public function token()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            $rarray = array('ack' => 0, );
            $this->set([
                'ack' => 0,
                'message' => 'Inavlid email or password.',
                '_serialize' => ['ack', 'message']
            ]);
        }
        else
        {
            if(empty($user['profile_image']))
            {
                $user['profile_image'] = 'default.png';
            }
            $user['image_url'] = Router::url('/', true).'user_img/';
            $user['token'] = JWT::encode([
                        'sub' => $user['id'],
                        'exp' =>  time() + 604800
                    ],
                    Security::salt());
            $this->set([
                'ack' => 1,
                'details' => $user,
                '_serialize' => ['ack', 'data','details']
            ]);
        }
    }
    
    public function register()
    {
        if($this->request->is('post')){
            $duplicate = $this->Users->find()->where(['email'=>$this->request->data['email'], 'isActive'=>1, 'isDeleted'=>0])->first();
            if(empty($duplicate)){
                
                if(@$this->request->data['profilePicture']['name'] != '') {
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
                        $rarray = array('ack' => 0,'message' => 'Upload image only jpg,jpeg,png files.');
                    } 
                } else {
                    $this->request->data['profilePicture']='';
                }

                $userdata = $this->Users->newEntity();
                $userdata = $this->Users->patchEntity($userdata, $this->request->data);
                if ($this->Users->save($userdata)) {
                    // $etRegObj = TableRegistry::get('EmailTemplates');
                    // $emailTemp = $etRegObj->find()->where(['id' => 2])->first()->toArray();

                    // $chkPost = base64_encode($rs->id . "/" . $themail);
                    // $mail_To = $themail;
                    // $mail_subject = $emailTemp['subject'];
                    // $url = Router::url('/', true);
                    // $link = $url . 'users/activeaccount/' . $chkPost;

                    // $mail_body = str_replace(array('[NAME]', '[LINK]'), array($this->request->data['first_name'], $link), $emailTemp['content']);
                    
                    // $email = new Email('default');
                    // $email->emailFormat('html')
                    //         ->to($mail_To)
                    //         ->subject($mail_subject)
                    //         ->send($mail_body);
                    $rarray = array('ack' => 1,'message' => 'Registerd successfully! Please check your mail for verification link.');
                } else {
                    $rarray = array('ack' => 0, 'message' => 'Internal error. Please try again later.');
                }
            }else{
                $rarray = array('ack' => 0,'message' => 'Email already exist.');
            }
        } else {
            $rarray = array('ack' => 0,'message' => 'Please insert data.');
        }

        $this->set([
            'details' => $rarray,
            '_serialize' => ['details']
        ]);
    }
    
    public function forgotpassword()
    {
    
        if ($this->request->is('post')) {
            // Checking if User is valid or not.

            $userExist = $this->Users->find()->where(['email'=>$this->request->data['email'], 'isActive'=>1, 'isDeleted'=>0])->first();
           
            if (!empty($userExist)) {
                $chkPost = rand(1000,9999); //Generating new Password

                $userExist->password = $chkPost;
                $this->Users->save($userExist);

                // $emailTemp = $this->EmailTemplates->find()->where(['id' => 1])->first()->toArray();
                // $mail_To = $userExist->email;
                // $mail_CC = '';
                // $mail_subject = $emailTemp['subject'];
                // $name = $userExist->first_name;
                // $url = Router::url('/', true);
                // $link = $url . 'users/setpassword/' . $chkPost;

                // $mail_body = str_replace(array('[NAME]', '[PASSWORD]'), array($name, $chkPost), $emailTemp['content']);
                // $email = new Email('default');

                // if ($email->emailFormat('html')
                //                 ->to($userExist->email)
                //                 ->subject($mail_subject)
                //                 ->send($mail_body)) {
                    
                //     $this->set([
                //         'ack' => 1,
                //         'message' => 'Please check your email for new password.',
                //         '_serialize' => ['ack', 'message']
                //     ]);
                // } else {
                //     $this->set([
                //         'ack' => 0,
                //         'message' => 'Ineternal error. Please try again later.',
                //         '_serialize' => ['ack', 'message']
                //     ]);
                // }

                $this->set([
                    'ack' => 1,
                    'newpass' => $chkPost,
                    'message' => 'Please check your email for new password.',
                    '_serialize' => ['ack','newpass', 'message']
                ]);
            } else {
                $this->set([
                    'ack' => 0,
                    'message' => 'Email Not Registerd With Us, try with another.',
                    '_serialize' => ['ack', 'message']
                ]);
            }
        }
    }

    public function changepassword(){
        $this->loadModel('Users');

        $user = $this->Users->get($this->request->data['user_id']);
        $existing_password = $user->password;

        $current_password = $this->request->data['current_password'];
        $new_password = $this->request->data['new_password'];
        $con_password = $this->request->data['con_password'];

        $hasher = new DefaultPasswordHasher();

        if($hasher->check($current_password, $existing_password)){

            if($new_password == $con_password){

                $update_password['password'] = $new_password;
                $user = $this->Users->patchEntity($user, $update_password);
                if ($this->Users->save($user)){
                    $this->set([
                            'Ack' => 1,
                            'message' => 'Password changed successfully',
                            '_serialize' => ['Ack','message']
                        ]);
                }
                else{
                    $this->set([
                            'Ack' => 1,
                            'message' => 'Error changing password. Please try again later',
                            '_serialize' => ['Ack','message']
                        ]);

                }

            }
            else{
                $this->set([
                    'Ack' => 0,
                    'message' => 'New password and confirm password mismatch',
                    '_serialize' => ['Ack','message']
                ]);
            }

        }
        else {
            $this->set([
                    'Ack' => 0,
                    'message' => 'Current password wrong',
                    '_serialize' => ['Ack','message']
                ]);
        }
        
    }


    public function updateuserprofile()
    {
        $user = $this->Users->get($this->request->data['user_id']);
        if ($this->request->is('post')) {
            
            if(@$this->request->data['profilePicture']['name'] != '') {
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
                    $this->set([
                        'Ack' => 1,
                        'message' => 'Upload image only jpg,jpeg,png files.',
                        '_serialize' => ['Ack','message']
                    ]);
                } 
            } else {
                $this->request->data['profilePicture'] = $this->request->data['oldimg'];
            }

            unset($this->request->data['oldimg']);
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->set([
                    'Ack' => 1,
                    'message'=>'Updated Successfully.',
                    '_serialize' => ['Ack','message']
                ]);
            } else {
                $this->set([
                    'Ack' => 0,
                    'message'=>'Error occured',
                    '_serialize' => ['Ack','message']
                ]);
            }
        } else {
            $this->set([
                'Ack' => 0,
                'message'=>'No data found',
                '_serialize' => ['Ack','message']
            ]);
        }
        
    }





       
}