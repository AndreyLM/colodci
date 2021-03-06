<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $menu domain\forms\menu\MenuForm */

/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">



            <?= $form->field($menu, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($menu, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($menu, 'status')->checkbox() ?>


        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
