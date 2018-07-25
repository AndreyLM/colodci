<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $cat_model domain\forms\CategoryForm */
/* @var $meta_model domain\forms\MetaForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($cat_model, 'parentId')->dropDownList($cat_model->parentCategoriesList()) ?>
            <?= $form->field($cat_model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($cat_model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($cat_model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($cat_model, 'description')->widget(CKEditor::className()) ?>

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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
