<?php

namespace backend\controllers;

use domain\forms\menu\MenuItemForm;
use domain\forms\MenuForm;
use domain\managers\MenuManager;
use domain\searches\MenuSearch;
use Yii;
use domain\entities\menu\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MenuItemController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\MenuManager $service
     * @param array $config
     */
    public function __construct($id, $module, MenuManager $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        /* @var $menu Menu */
        $menu = $this->service->getMenu($id);


        return $this->render('index',[
            'menu' => $menu,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $menu = $this->service->getMenu($id);
        $root = $this->service->getRootMenuItem($id);

        return $this->render('view', [
            'menu' => $this->service->getMenu($id),
            'root' => $root
        ]);
    }

    /**
     * @param $menuId
     * @return mixed
     */

    public function actionCreate($menuId)
    {
        $menuItemForm = new MenuItemForm();
        $root = $this->service->getRootMenuItem($menuId);


        $parentList = $this->service->getItemsList($menuId);

        if ($menuItemForm->load(Yii::$app->request->post()) && $menuItemForm->validate())
        {

            try {
                $menuItem = $this->service->createMenuItem($menuItemForm);
                return $this->redirect(['view', 'id' => $menuItem->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'menuItemForm' => $menuItemForm,
            'parentList' => $parentList,
            'root' => $root,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /* @var $item Menu*/
        $item = $this->service->getMenu($id);
        $root = $this->service->getRootMenuItem($id);
        $parentList = $this->service->getItemsList($root['id']);


        $itemForm = new MenuItemForm($item);

        if ($itemForm->load(Yii::$app->request->post()) && $itemForm->validate()) {
            try {
                $this->service->editMenuItem($item->id, $itemForm);
                return $this->redirect(['view', 'id' => $item->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'menuItemForm' => $itemForm,
            'parentList' => $parentList,
            'root' => $root,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveUp($id)
    {
        $this->service->moveUp($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveDown($id)
    {
        $this->service->moveDown($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
