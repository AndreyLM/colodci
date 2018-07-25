<?php
/* @var $this yii\web\View */
/* @var $product_model domain\forms\ProductForm */
/* @var $meta_model domain\forms\MetaForm */
/* @var $photo_model domain\forms\PhotosForm */

$this->title = 'Редактировать продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-update">
    <?=
    $this->render('_form', [
        'product_model' => $product_model,
        'meta_model' => $meta_model,
        'photo_model' => $photo_model,
    ]);
    ?>
</div>
