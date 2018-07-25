<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $product \domain\entities\Product */

use yii\helpers\Html;


$this->title = $product->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">
    <div class="row">
        <div class="col-md-12">
            <h1 class="product-title">
                <?= Html::encode($product->title) ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">

            <ul class="thumbnails">
                <?php foreach ($product->photos as $i => $photo): ?>
                    <?php if ($i == 0): ?>
                        <li>
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                                <img src="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>" alt="<?= Html::encode($product->name) ?>" />
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="image-additional">
                            <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" title="HP LP3065">
                                <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="" />
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                
        </div>
        <div class="col-md-7">
            <h3><?= Html::encode($product->name) ?></h3>
            <p>Код: <?= Html::encode($product->code) ?></p>
            <p>Категория: <?= Html::encode($product->category->name) ?></p>
            <p></p>
            <p></p>
            <p class="product-price"><b>Цена: <?= $product->price ?> UAH</b></p>
            <p><?= Html::a('Купить', ['cart/add', 'id' => $product->id], ['class' => 'btn custom-button'])?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Описание:</p>
            <p><?= $product->description ?></p>
        </div>
    </div>
</div>

