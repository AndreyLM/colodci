<?php

namespace domain\managers;

use domain\entities\Meta;
use domain\entities\Category;
use domain\forms\CategoryForm;
use domain\forms\MetaForm;
use domain\repositories\CategoryRepository;
use domain\repositories\ProductRepository;

class CategoryManager
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function getOne($id) {
        return $this->categories->get($id);
    }

    public function create(CategoryForm $form, MetaForm $meta)
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $meta->title,
                $meta->description,
                $meta->keywords
            )
        );

        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form, MetaForm $meta): void
    {
        $category = $this->categories->get($id);

        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $meta->title,
                $meta->description,
                $meta->keywords
            )
        );
        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    public function remove($id)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);

//        if ($this->products->existsByMainCategory($category->id)) {
//            throw new \DomainException('Unable to remove category with products.');
//        }

        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category)
    {
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }
}