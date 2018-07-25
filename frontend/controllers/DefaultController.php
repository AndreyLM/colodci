<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/17/18
 * Time: 10:25 AM
 */

namespace frontend\controllers;

use domain\managers\ContactManager;
use domain\managers\MenuManager;
use yii\base\Module;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * @var MenuManager
     */
    protected $menuManager;
    /**
     * @var ContactManager
     */
    private $contactManager;

    public function __construct($id, Module $module, MenuManager $menuManager, ContactManager $contactManager, array $config = [])
    {
        $this->menuManager = $menuManager;
        $this->contactManager = $contactManager;
        $this->customSettings();
        parent::__construct($id, $module, $config);
    }

    private function customSettings()
    {
        $this->view->params['headMenu'] = $this->menuManager->getHeaderMenu(\Yii::$app->getUrlManager());
        $this->view->params['sideMenu'] = $this->menuManager->getSideMenu(\Yii::$app->getUrlManager());
        $this->view->params['social'] = $this->contactManager->getSocialContacts();
        $this->view->params['phones'] = $this->contactManager->getPhoneContacts();
    }
}