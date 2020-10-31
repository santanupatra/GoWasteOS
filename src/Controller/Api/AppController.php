<?php
namespace App\Controller\Api;
use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        
        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                    'scope' => ['Users.isActive' => 1],
                    'userModel' => 'Users',
                    'fields' => [
                        'username'=>'email',
                        'password'=>'password'
                    ],
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => 'token',
                    'userModel' => 'Users',
                    'scope' => ['Users.isActive' => 1],
                    'fields' => [
                        'username' => 'id'
                    ],
                    'queryDatasource' => true
                ]
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);
    }
}