<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $menu domain\entities\menu\Menu */

$this->title = $menu->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $menu->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $menu->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Menu info</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $menu,
                'attributes' => [
                    'id',
                    'title',
                    'name',
                    'depth',
                    'status'
                ],
            ]) ?>
        </div>
    </div>

    <p>
        <?= Html::a('Пункты меню', ['menu-item/index', 'id' => $menu->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>
