<?php
/* @var $this yii\web\View */
/* @var $article_model domain\forms\ArticleForm */
/* @var $meta_model domain\forms\MetaForm */
/* @var $photo_model domain\forms\PhotosForm */

$this->title = 'Обновить статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <?=
    $this->render('_form', [
        'article_model' => $article_model,
        'meta_model' => $meta_model,
    ]);
    ?>
</div>
