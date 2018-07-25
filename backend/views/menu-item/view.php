<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $menu domain\entities\menu\Menu */
/* @var $root [] */

$this->title = $menu->name;
$this->params['breadcrumbs'][] = ['label' => $root['title'],
    'url' => Url::to(['menu/view', 'id' =>$root['id'] ])];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $menu->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $menu->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно желаете удалить даный пункт меню?',
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
                    'type',
                    'related_id',
                    'status'
                ],
            ]) ?>
        </div>
    </div>

</div>
