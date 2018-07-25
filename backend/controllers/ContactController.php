<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/18
 * Time: 6:01 AM
 */

namespace backend\controllers;


use domain\forms\ContactForm;
use domain\managers\ContactManager;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    /**
     * CategoryController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param \domain\managers\ContactManager $service
     * @param array $config
     */
    public function __construct($id, $module, ContactManager $service, $config = [])
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

    public function actionIndex()
    {
        $models = $this->service->getAll();

        return $this->render('index', [
           'models' => $models
        ]);
    }

    public function actionView($id)
    {
        $model = $this->service->getById($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $contactForm = new ContactForm();

        if ($contactForm->load(Yii::$app->request->post()) && $contactForm->validate())
        {
            try {
                $contactId = $this->service->create($contactForm);
                return $this->redirect(['view', 'id' => $contactId]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $contactForm
        ]);
    }

    public function actionUpdate($id)
    {
        $contactForm = new ContactForm($this->service->getById($id));


        if ($contactForm->load(Yii::$app->request->post()) && $contactForm->validate())
        {
            try {
                $this->service->update($contactForm);
                return $this->redirect(['view', 'id' => $contactForm->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $contactForm
        ]);
    }

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
}