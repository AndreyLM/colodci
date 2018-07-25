<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use domain\helpers\ArticleHelper;

/* @var $this yii\web\View */
/* @var $article_model domain\forms\ArticleForm */
/* @var $meta_model domain\forms\MetaForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($article_model, 'id')->hiddenInput(['value'=>$article_model->id])->label(false) ?>
            <?= $form->field($article_model, 'category_id')->dropDownList(ArticleHelper::getCategoryList()) ?>
            <?= $form->field($article_model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($article_model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($article_model, 'content_intro')->widget(CKEditor::className(), [

                'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),

            ]) ?>
            <?= $form->field($article_model, 'content')->widget(CKEditor::className()) ?>
            <?= $form->field($article_model, 'created_at')->textInput(['maxlength' => true]) ?>
            <?= $form->field($article_model, 'publishing_at')->textInput(['maxlength' => true]) ?>
            <?= $form->field($article_model, 'status')->checkbox() ?>



        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($meta_model, 'title')->textInput() ?>
            <?= $form->field($meta_model, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($meta_model, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
