<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/17/18
 * Time: 3:29 PM
 */

namespace common\widgets;

use yii\base\Widget;

class HeadMenu extends Widget
{
    public $items = [];

    public function run()
    {

        $result = '<ul class="nav navbar-nav main-menu">';

        foreach ($this->items as $item) {
            $result .= '<li>';
            $result .= '<a href="'.$item['href'].'"><b>'.$item['title'].'</b></a>';
            $result .= '</li>';
        }

        $result .= '</ul>';

        return $result;
    }
}