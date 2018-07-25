<?php

namespace frontend\controllers;

use domain\managers\ContactManager;
use domain\managers\MenuManager;
use domain\managers\ProductManager;
use Yii;
use yii\helpers\Url;

class CatalogController extends DefaultController
{
    private $productManager;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function __construct($id, $module, MenuManager $menuManager, ProductManager $productManager, ContactManager $contactManager, $config = [])
    {
        parent::__construct($id, $module, $menuManager, $contactManager, $config);
        $this->productManager = $productManager;
    }

    public function actionList()
    {
        try {
            $recommendedProducts = $this->productManager->getRecommended(10);
        } catch (\DomainException $exception) {
            $recommendedProducts = [];
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }


        try {
            $latestProducts = $this->productManager->getLatest(10);
        } catch (\DomainException $exception) {
            $latestProducts = [];
            Yii::$app->session->setFlash('error', $exception->getMessage());
        }


        return $this->render('list', [
            'recommendedProducts' => $recommendedProducts,
            'latestProducts' => $latestProducts,
        ]);
    }

    public function actionView($id)
    {

        $product = $this->productManager->getProductById($id);

        return $this->render('view', [
            'product' => $product,
        ]);
    }
}
