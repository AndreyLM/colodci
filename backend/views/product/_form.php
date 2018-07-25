<?php

use domain\helpers\ProductHelper;
use kartik\widgets\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $product_model domain\forms\ProductForm */
/* @var $meta_model domain\forms\MetaForm */
/* @var $photo_model domain\forms\PhotosForm */
?>

<div class="product-create">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($product_model, 'category_id')->dropDownList(ProductHelper::getCategoryList()) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($product_model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($product_model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($product_model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($product_model, 'price')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($product_model, 'status')->checkbox() ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($product_model, 'recommended')->checkbox() ?>
                </div>

            </div>
            <?= $form->field($product_model, 'description')->widget(CKEditor::className()) ?>
        </div>
    </div>




    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">
            <?= $form->field($photo_model, 'files[]')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
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
