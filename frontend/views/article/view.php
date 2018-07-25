<?php

/* @var $this yii\web\View */
/* @var $model domain\entities\Article */


$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <h3><?= $model->title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= $model->content_intro.$model->content ?>
    </div>
</div>
