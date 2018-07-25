<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $article \domain\entities\Article */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = $article->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($article->title) ?></h1>
    <p><i><small>Дата публикации: <?=date('Y/m/d h:m',Html::encode($article->publishing_at))?></small></i></p>
    <p>
        <?= $article->content_intro ?>
        <?= $article->content ?>
    </p>
</div>
