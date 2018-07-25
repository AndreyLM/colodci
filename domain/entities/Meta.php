<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.06.17
 * Time: 16:29
 */
namespace domain\entities;

class Meta
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}