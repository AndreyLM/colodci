<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.06.17
 * Time: 16:29
 */

namespace domain\entities\queries;


use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;

class MenuQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;
}