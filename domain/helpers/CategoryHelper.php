<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.06.17
 * Time: 11:30
 */

namespace domain\helpers;


use domain\entities\Category;
use yii\helpers\ArrayHelper;

class CategoryHelper
{
    public static function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public static function getProductCategoriesList(): array
    {
        $product_category = Category::findOne(10);
        return ArrayHelper::map(Category::find()->where(['>', 'lft', $product_category->lft])
            ->andWhere(['<', 'rgt', $product_category->rgt])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 2 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }
}