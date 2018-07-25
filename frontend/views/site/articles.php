<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $articles[] \domain\entities\Article */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($articles as $article): ?>
        <h2><?=$article->title ?></h2>
        <p><?=$article->content_intro?></p>
        <br>
        <a href="<?= \yii\helpers\Url::to(['site/article', 'id' => $article->id])?>">Подробнее...</a>

    <?php endforeach;?>


</div>
