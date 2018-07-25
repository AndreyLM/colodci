<?php

/* @var $this yii\web\View */
/* @var $cat_model domain\forms\CategoryForm */
/* @var $meta_model domain\forms\MetaForm */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'cat_model' => $cat_model,
        'meta_model' => $meta_model,
    ]) ?>

</div>
