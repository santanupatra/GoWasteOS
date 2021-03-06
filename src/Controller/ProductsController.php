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
class ProductsController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index','details','product']);
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
    public function index(){
        $this->loadModel('Banners');
        $products = $this->Products->find()->where(['isActive'=>1])->contain(['ProductImages'])->toArray();
        // print_r($products); exit;
        $this->set(compact('products'));
    }

    public function details($slug = null){
        $product = $this->Products->find()->where(['slug'=>$slug])->contain(['ProductImages'])->first();
        // print_r($product); exit;
        $this->set(compact('product'));
    }

    public function product(){
        $this->loadModel('CmsPages');
        $product = $this->CmsPages->get(3);
        $this->set(compact('product'));
    }
}
