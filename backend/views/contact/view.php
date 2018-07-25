<?php

use domain\entities\Contact;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model domain\entities\Contact*/

$this->title = $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Контакти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы подтверждаете удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Contact info</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'text',
                    'url',
                    [
                        'label' => 'Тип',
                        'value' => function(Contact $contact) {
                            return $contact->getCurrentType();
                        }
                    ],
                    'position'

                ]]); ?>
        </div>
    </div>
</div>
