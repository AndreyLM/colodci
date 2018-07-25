<?php
namespace frontend\controllers;

use domain\entities\Comments;
use domain\entities\Product;
use domain\managers\ArticleManager;
use domain\managers\ProductManager;
use domain\repositories\ArticleRepository;
use domain\repositories\ProductRepository;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends DefaultController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['catalog/list']);
    }

    public function actionArticle($id)
    {
        $manager = new ArticleManager(new ArticleRepository());

        $article = $manager->getById($id);

        return $this->render('article', [
           'article' => $article,
        ]);

    }


    public function actionArticles($category = 0)
    {
        $manager = new ArticleManager(new ArticleRepository());

        $articles = $manager->getArticlesByCategory($category);

        return $this->render('articles', [
           'articles' => $articles,
        ]);

    }

    public function actionComments()
    {
        $comments = Comments::find()->all();
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['comments']);
        } else {
            return $this->render('comments', [
                'comments' => $comments,
                'model' => $model,
            ]);
        }
    }



    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



}
