<?php

/* @var $this yii\web\View */
/* @var $menu_form domain\entities\menu\Menu */
/* @var $menu domain\forms\menu\MenuForm */


$this->title = 'Редактировать меню: ' . $menu->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $menu->name, 'url' => ['view', 'id' => $menu->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'menu' => $menu_form,
    ]) ?>

</div>
