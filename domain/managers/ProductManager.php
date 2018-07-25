<?php

namespace domain\managers;

use domain\entities\Meta;
use domain\entities\Photo;
use domain\entities\Product;
use domain\forms\MetaForm;
use domain\forms\PhotosForm;
use domain\forms\ProductForm;
use domain\repositories\ProductRepository;

class ProductManager
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRecommended($count)
    {
        try{
            return $this->repository->getRecommended($count);
        }catch (\DomainException $exception) {
            throw new \DomainException('Рекомендуемых товаров не найдено');
        }
    }

    public function getLatest($count)
    {
        try {
            return $this->repository->getLatest($count);
        } catch (\DomainException $exception) {
            throw new \DomainException('Новые поступленния отсутствуют');
        }

    }

    public function create(ProductForm $productForm, MetaForm $metaForm, $photos)
    {
        $product = Product::create(
            $productForm,
            $metaForm);

        $this->repository->save($product);

        foreach ($photos->files as $photo)
        {
            $product->addPhoto($photo);
        }

        return $product->id;
    }

    public function edit(ProductForm $productForm, MetaForm $metaForm, $photos)
    {
        /* @var $product Product*/
        $product = $this->repository->get($productForm->id);

        $product->edit($productForm, $metaForm);

        $this->repository->save($product);

        foreach ($photos->files as $photo)
        {
            $product->addPhoto($photo);
        }

        return $product->id;
    }

    public function makeActive($id)
    {
        $this->repository->makeActive($id);
    }

    public function makeUnActive($id)
    {
        $this->repository->makeUnActive($id);
    }

    public function makeRecommended($id)
    {
        $this->repository->makeRecommended($id);
    }

    public function makeUnRecommended($id)
    {
        $this->repository->makeUnRecommended($id);
    }

    public function save(Product $product)
    {
        $this->repository->save($product);
    }

    public function addPhotos($id, PhotosForm $photos)
    {
        $product = $this->repository->get($id);

        foreach ($photos->files as $photo) {
            $product->addPhoto($photo);
        }
    }

    public function removePhoto($id, $photoId): void
    {
        $photo = Photo::findOne($photoId);
        $photo->delete();
    }

    public function remove($id)
    {
        $this->repository->remove($id);
    }

    public function getProductsByCategory($id)
    {
        return $this->repository->getByCategory($id);
    }

    public function getProductById($id)
    {
        return $this->repository->get($id);
    }
}