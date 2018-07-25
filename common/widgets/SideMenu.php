<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/17/18
 * Time: 3:29 PM
 */

namespace common\widgets;

use yii\base\Widget;

class SideMenu extends Widget
{
    public $items = [];

    public function run()
    {
        $result = '<div class="box-content">';
        $result .= '<div class="box-category">';
        $result .= '<ul>';

        foreach ($this->items as $item) {
            $result .= '<li>';
            $result .= '<a href="'.$item['href'].'"><b>'.$item['title'].'</b></a>';
            $result .= '</li>';
        }

        $result .= '</ul></div></div>';

        return $result;
    }
}