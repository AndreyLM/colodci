<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.06.17
 * Time: 8:17
 */
namespace domain\repositories;

use domain\entities\menu\Menu;
use domain\NotFoundException;

class MenuRepository
{

    public function __construct()
    {

    }

    public function get($id)
    {
        if (!$menu = Menu::findOne($id)) {
            throw new NotFoundException('Menu is not found.');
        }

        return $menu;
    }

    public function save(Menu $menu)
    {
        if (!$menu->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Menu $menu)
    {
        if (!$menu->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function getByName($name)
    {
        if (!$menu = Menu::findOne(['name' => $name])) {
            throw new NotFoundException('Menu is not found.');
        }

        return $menu;
    }

    public function getRootMenuItem($itemId)
    {

        $item = $this->get($itemId);

        if($item->depth === 1)
            return ['id' => $item->id, 'title' => $item->title];

        /* @var $root Menu*/
        $root = Menu::find()->where(['<', 'lft', $item->lft])
            ->andWhere(['>', 'rgt', $item->rgt])->andWhere('depth=1')->one();

        return ['id' => $root->id, 'title' => $root->title];
    }

}