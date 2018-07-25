<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \domain\entities\Comments */
/* @var $comments[] \domain\entities\Comments */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Оставьте свой отзыв или пожелание!
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'comments']); ?>

            <?= $form->field($model, 'user')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php foreach ($comments as $comment):?>
        <div class="row">
            <div class="col-md-12">
                <p><b><?= $comment->user ?></b><br>
                <b><?= $comment->subject ?></b></p>
            </div>
            <div class="col-md-5 reviews"><?= $comment->message ?></div>
            <div class="col-md-7"></div>
        </div>
        <hr>
    <?php endforeach; ?>

</div>
