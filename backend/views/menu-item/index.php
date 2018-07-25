<?php

use domain\entities\Category;
use domain\entities\menu\Menu;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $menu Menu */

$this->title = $menu->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Добавить пункт меню', ['create', 'menuId' => $menu->id], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?php foreach ($menu->descendants as $item ) { ?>
                <div class="row">
                    <div class="col-md-8">
                        <?= str_repeat('-', $item->depth-1). $item->title ?>
                    </div>
                    <div class="col-md-4">
                        <?=Html::a('<i class="fa fa-eye"></i>', ['view', 'id'=>$item->id])?>
                        <?=Html::a('<i class="fa fa-trash"></i>', ['delete', 'id'=>$item->id])?>
                        <?=Html::a('<i class="fa fa-pencil"></i>', ['update', 'id'=>$item->id])?>
                    </div>
                </div>
                <hr>
            <?php } ?>

        </div>
    </div>
</div>
