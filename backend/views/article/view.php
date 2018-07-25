<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $article domain\entities\Article */

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $article->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $article->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<!--    public $id;-->
<!--    public $category_id;-->
<!--    public $title;-->
<!--    public $content_into;-->
<!--    public $content;-->
<!--    public $created_at;-->
<!--    public $publishing_at;-->
<!--    public $status;-->
<!--    public $slug;-->

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $article,
                'attributes' => [
                    'id',
                    'category.name',
                    'slug',
                    'title',
                    'content_intro',
                    'content',
                    'created_at',
                    'publishing_at',
                    'status',
                ],
            ]) ?>
        </div>
    </div>


    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $article,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>
</div>
