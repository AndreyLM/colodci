<?php


namespace domain\repositories;


use domain\entities\Product;
use domain\NotFoundException;

class ProductRepository
{
    public function get($id)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException("Can't find product");
        }
        return $product;
    }

    public function getByCategory($id)
    {
        if (!$products = Product::find()->where(['category_id' => $id])->all()) {
            throw new NotFoundException("Can't find category");
        }
        return $products;
    }

    public function save(Product $product)
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }

    }

    public function remove($id)
    {
        $product = $this->get($id);
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }

    }

    public function makeActive($id)
    {
        $product = $this->get($id);

        if($product->isActive()) {
            return ;
        }

        $product->makeActive();
        $product->save();
    }

    public function makeUnActive($id)
    {
        $product = $this->get($id);

        if(!$product->isActive()) {
            return ;
        }

        $product->makeUnActive();
        $product->save();
    }

    public function makeRecommended($id)
    {
        $product = $this->get($id);

        if($product->isRecommended()) {
            return ;
        }

        $product->makeRecommended();
        $product->save();
    }

    public function makeUnRecommended($id)
    {
        $product = $this->get($id);

        if(!$product->isRecommended()) {
            return ;
        }

        $product->makeUnRecommended();
        $product->save();
    }

    public function getAll()
    {
        if(!$products = Product::find()->all()) {
            throw new \DomainException("Can't get products");
        }

        return $products;
    }

    public function getRecommended($count)
    {
        if(!$products = Product::find()->where('recommended=1')->limit($count)->all()) {
            throw new \DomainException("Can't get products");
        }

        return $products;
    }

    public function getLatest($count)
    {
        if(!$products = Product::find()->orderBy(['created_at' => SORT_DESC, 'name' => SORT_ASC])->limit($count)->all()) {
            throw new \DomainException("Can't get products");
        }

        return $products;
    }

}