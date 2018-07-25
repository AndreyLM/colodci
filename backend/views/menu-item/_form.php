<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $menuItemForm domain\forms\menu\MenuItemForm */
/* @var $parentList [] */

/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">

            <?= $form->field($menuItemForm, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($menuItemForm, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($menuItemForm, 'type')->dropDownList($menuItemForm->getItemTypes()) ?>

            <?= $form->field($menuItemForm, 'relation')->textInput(['maxlength' => true]) ?>

            <?= $form->field($menuItemForm, 'parentId')->dropDownList($parentList) ?>

            <?= $form->field($menuItemForm, 'status')->checkbox() ?>


        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
