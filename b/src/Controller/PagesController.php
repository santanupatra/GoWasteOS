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
class PagesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['home','ajaxMessage','about','faq','legal']);
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
    public function home(){
        $this->loadModel('Banners');
        $this->loadModel('Services');
        $this->loadModel('Products');
        $this->loadModel('ProductImages');
        $headerBanner = $this->Banners->get(1);
        $productBanner = $this->Banners->get(2);
        $contactBanner = $this->Banners->get(3);
        $sliderBanner = $this->Banners->get(4);
        $products = $this->Products->find()->contain(['ProductImages'])->limit(4)->toArray();
        $this->set(compact('headerBanner','productBanner','contactBanner','sliderBanner','products'));
    }

    public function about(){
        $this->loadModel('CmsPages');
        $about = $this->CmsPages->get(1);
        $this->set(compact('about'));
    }

    public function faq(){
        $this->loadModel('Faqs');
        $faqs = $this->Faqs->find()->where(['isActive'=>1])->toArray();
        $this->set(compact('faqs'));
    }

    public function legal(){
        $this->loadModel('CmsPages');
        $legal = $this->CmsPages->get(2);
        $this->set(compact('legal'));
    }
}
