<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

/* @var $menuItemForm domain\forms\menu\MenuItemForm */
/* @var $parentList [] */
/* @var $root [] */


$this->title = 'Создать пункт меню';
$this->params['breadcrumbs'][] = ['label' => $root['title'],
    'url' => Url::to(['menu/view', 'id' =>$root['id'] ])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'menuItemForm' => $menuItemForm,
        'parentList' => $parentList,
    ]) ?>

</div>
