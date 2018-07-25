<?php
use \yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products domain\entities\Product[] */
?>
<h1 class="cart-title">Корзина покупок</h1>

<div class="container-fluid">
    <div class="row cart-headers">
        <div class="col-xs-4">
            Наименование товара
        </div>
        <div class="col-xs-2">
            Кол-во
        </div>
        <div class="col-xs-2">
            Цена
        </div>
        <div class="col-xs-2">
            Итого
        </div>
        <div class="col-xs-2">

        </div>
    </div>
    <?php foreach ($products as $product):?>
    <div class="row cart-list-row">
        <div class="col-xs-4">
            <?= Html::encode($product->title) ?>
        </div>
        <div class="col-xs-2">
            <?php $quantity = $product->getQuantity()?>

            <?= Html::a('-', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-default', 'disabled' => ($quantity - 1) < 1])?>
            <?= $quantity ?>
            <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-default'])?>

        </div>
        <div class="col-xs-2">
            $<?= $product->price ?>
        </div>
        <div class="col-xs-2">
            $<?= $product->getCost() ?>
        </div>
        <div class="col-xs-2">
            <?= Html::a('×', ['cart/remove', 'id' => $product->getId()], ['class' => 'btn '])?>
        </div>
    </div>
    <?php endforeach ?>

    <br>

    <div class="row">
        <div class="col-xs-4">
            <?= Html::a('ПРОДОЛЖИТЬ ПОКУПКИ', Url::previous(), ['class' => 'btn custom-button-invert'])?>

        </div>
        <div class="col-xs-4">
            <span class="sum">ИТОГО:</span> <span class="sum-val"><?= $total ?> ГРН</span>
        </div>
        <div class="col-xs-4">
            <?= Html::a('ОФОРМЛЕНИЕ ЗАКАЗА', ['cart/order'], ['class' => 'btn custom-button'])?>
        </div>
    </div>

</div>
