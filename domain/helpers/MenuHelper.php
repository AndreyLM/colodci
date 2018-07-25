<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.06.17
 * Time: 5:23
 */

namespace domain\helpers;


use domain\entities\Menu;
use domain\managers\MenuManager;

class MenuHelper
{
    public static function getMenuItems()
    {
        $menus = Menu::find()->orderBy('lft')->all();



        $items = [];

        $url = '';

        foreach ($menus as $menu)
        {
            if($menu->name == 'root') {
                continue ;
            }

            if($menu->type == Menu::MENU_TYPE_ARTICLE) {
                $url = ['site/article', 'id'=>$menu->related_id];
            }

            if($menu->type == Menu::MENU_TYPE_PRODUCT) {
                $url = ['site/product', 'id'=>$menu->related_id];
            }

            if($menu->type == Menu::MENU_TYPE_CATEGORY) {
                $url = ['site/articles', 'category'=>$menu->related_id];
            }

            if($menu->type == Menu::MENU_TYPE_CAT_PRODUCTS) {
                $url = ['site/products', 'category'=>$menu->related_id];
            }

            $items[] = ['label' => $menu->name, 'url' => $url];

        }

//        echo var_dump($items); die;

        return $items;
    }
}