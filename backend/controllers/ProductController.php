<?php

namespace backend\controllers;

use domain\entities\Product;
use domain\forms\MetaForm;
use domain\forms\PhotosForm;
use domain\forms\ProductForm;
use domain\managers\ProductManager;
use domain\searches\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ProductController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\ProductManager $service
     * @param array $config
     */
    public function __construct($id, $module, ProductManager $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors()
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
        $searchModel = new ProductSearch();
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
        $product = $this->findModel($id);

        $photosForm = new PhotosForm();

        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($product->id, $photosForm);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('view', [
            'product' => $product,
            'photosForm' => $photosForm,
        ]);
    }

    /**
     * @return mixed
     */

    public function actionCreate()
    {
        $product_model = new ProductForm();
        $meta_form = new MetaForm();
        $photo_form = new PhotosForm();


        if ($product_model->load(Yii::$app->request->post()) && $product_model->validate()
            && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate()
            && $photo_form->load(Yii::$app->request->post()) && $photo_form->validate())
        {
            try {
                $product_id = $this->service->create($product_model, $meta_form, $photo_form);
                return $this->redirect(['view', 'id' => $product_id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'product_model' => $product_model,
            'meta_model' => $meta_form,
            'photo_model' => $photo_form,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);

        $product_model = new ProductForm($product);
        $meta_form = new MetaForm($product->meta);
        $photo_form = new PhotosForm();


        if ($product_model->load(Yii::$app->request->post()) && $product_model->validate()
            && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate()
            && $photo_form->load(Yii::$app->request->post()) && $photo_form->validate())
        {
            try {
                $product_id = $this->service->edit($product_model, $meta_form, $photo_form);
                return $this->redirect(['view', 'id' => $product_id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'product_model' => $product_model,
            'meta_model' => $meta_form,
            'photo_model' => $photo_form,
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

    public function actionMakeUnActive($id)
    {
        $this->service->makeUnActive($id);
        return $this->redirect(['index']);
    }

    public function actionMakeActive($id)
    {
        $this->service->makeActive($id);
        return $this->redirect(['index']);
    }

    public function actionMakeUnRecommended($id)
    {
        $this->service->makeUnRecommended($id);
        return $this->redirect(['index']);
    }

    public function actionMakeRecommended($id)
    {
        $this->service->makeRecommended($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }
}
