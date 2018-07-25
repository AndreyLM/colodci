<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.06.17
 * Time: 8:17
 */
namespace domain\repositories;

use domain\entities\Category;
use domain\NotFoundException;

class CategoryRepository
{

    public function __construct()
    {

    }

    public function get($id)
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    public function save(Category $category)
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Category $category)
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function existsByMainCategory($id)
    {
//        $products =
    }

}