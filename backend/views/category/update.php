<?php

/* @var $this yii\web\View */
/* @var $category domain\entities\Category */
/* @var $cat_model domain\forms\CategoryForm */
/* @var $meta_model domain\forms\MetaForm */

$this->title = 'Редактировать категорию: ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'cat_model' => $cat_model,
        'meta_model' => $meta_model,
    ]) ?>

</div>
