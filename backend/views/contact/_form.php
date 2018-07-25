<?php

use domain\entities\Contact;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model domain\forms\ContactForm */

/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">

            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'url')->textInput() ?>
            <?= $form->field($model, 'type')->dropDownList(Contact::getTypes()) ?>
            <?= $form->field($model, 'position')->textInput() ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
