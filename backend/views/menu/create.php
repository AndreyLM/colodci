<?php

/* @var $this yii\web\View */
/* @var $menu domain\forms\menu\MenuForm */


$this->title = 'Создать меню';
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'menu' => $menu,
    ]) ?>

</div>
