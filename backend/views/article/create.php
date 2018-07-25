<?php

/* @var $this yii\web\View */
/* @var $article_model domain\forms\ArticleForm */
/* @var $meta_model domain\forms\MetaForm */

$this->title = 'Создать статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'article_model' => $article_model,
        'meta_model' => $meta_model,
    ]) ?>

</div>
