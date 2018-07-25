<?php

namespace backend\controllers;

use domain\forms\CategoryForm;
use domain\forms\MetaForm;
use domain\managers\CategoryManager;
use domain\searches\CategorySearch;
use Yii;
use domain\entities\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\CategoryManager $service
     * @param array $config
     */
    public function __construct($id, $module, CategoryManager $service, $config = [])
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
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'category' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */

    public function actionCreate()
    {
        $cat_form = new CategoryForm();
        $meta_form = new MetaForm();
        if ($cat_form->load(Yii::$app->request->post()) && $cat_form->validate()
        && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate())
        {
            try {
                $category = $this->service->create($cat_form, $meta_form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'cat_model' => $cat_form,
            'meta_model' => $meta_form,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $category = $this->findModel($id);

        $cat_form = new CategoryForm($category);
        $meta_form = new MetaForm($category->meta);
        if ($cat_form->load(Yii::$app->request->post()) && $cat_form->validate()
            && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate()) {
            try {
                $this->service->edit($category->id, $cat_form, $meta_form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'cat_model' => $cat_form,
            'meta_model' => $meta_form,
            'category' => $category,
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
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Category
    {

        if (($model = $this->service->getOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
