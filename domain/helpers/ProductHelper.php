<?php

namespace domain\helpers;

use domain\entities\Article;

use domain\entities\Category;
use domain\entities\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class ProductHelper
{
    public static function statusList(): array
    {
        return [
            Product::UN_ACTIVE => 'Не активные',
            Product::ACTIVE => 'Активные',
        ];
    }

    public static function recommendedList(): array
    {
        return [
            Product::UNRECOMMENDED => 'Не рекомендуемый',
            Product::RECOMMENDED => 'Рекомендуемый',
        ];
    }

    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status, $id = null, $makeUrl = true)
    {
        switch ($status) {
            case Product::UN_ACTIVE:
                $class = 'label label-default';
                $url = Url::to(['product/make-active', 'id'=>$id]);
                break;
            case Product::ACTIVE:
                $class = 'label label-success';
                $url = Url::to(['product/make-un-active', 'id'=>$id]);
                break;
            default:
                $class = 'label label-default';
                $url = Url::to(['product/make-active', 'id'=>$id]);
        }

        if ($makeUrl) {
            return Html::a(Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
                'class' => $class,
            ]), $url);
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function recommendedLabel($recommended, $id = null, $makeUrl = true)
    {
        switch ($recommended) {
            case Product::UNRECOMMENDED:
                $class = 'label label-default';
                $url = Url::to(['product/make-recommended', 'id'=>$id]);
                break;
            case Product::RECOMMENDED:
                $class = 'label label-success';
                $url = Url::to(['product/make-un-recommended', 'id'=>$id]);
                break;
            default:
                $class = 'label label-default';
                $url = Url::to(['product/make-recommended', 'id'=>$id]);
        }

        if ($makeUrl) {
            return Html::a(Html::tag('span', ArrayHelper::getValue(self::recommendedList(), $recommended), [
                'class' => $class,
            ]), $url);
        }

        return Html::tag('span', ArrayHelper::getValue(self::recommendedList(), $recommended), [
            'class' => $class,
        ]);
    }

    public static function getCategoryList()
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
}