<?php

namespace backend\controllers;

use domain\entities\Article;
use domain\forms\ArticleForm;
use domain\forms\MetaForm;
use domain\managers\ArticleManager;
use domain\searches\ArticleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ArticleController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\ArticleManager $service
     * @param array $config
     */
    public function __construct($id, $module, ArticleManager $service, $config = [])
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
        $searchModel = new ArticleSearch();
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
            'article' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */

    public function actionCreate()
    {
        $article_model = new ArticleForm();
        $meta_form = new MetaForm();
        if ($article_model->load(Yii::$app->request->post()) && $article_model->validate()
            && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate())
        {
            try {
                $article_id = $this->service->create($article_model, $meta_form);
                return $this->redirect(['view', 'id' => $article_id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'article_model' => $article_model,
            'meta_model' => $meta_form,
        ]);
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

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $article = $this->findModel($id);

        $article_form = new ArticleForm($article);
        $meta_form = new MetaForm($article->meta);
        if ($article_form->load(Yii::$app->request->post()) && $article_form->validate()
            && $meta_form->load(Yii::$app->request->post()) && $meta_form->validate()
        ) {
            try {
                $this->service->edit($article_form, $meta_form);
                return $this->redirect(['view', 'id' => $article->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage().' -- ');
            }
        }

        $article_form->id = $article->id;

        return $this->render('update', [
            'article' => $article,
            'article_model' => $article_form,
            'meta_model' => $meta_form,
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
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
