<?php

namespace domain\managers;

use domain\entities\Article;
use domain\entities\Meta;
use domain\forms\ArticleForm;
use domain\forms\MetaForm;
use domain\repositories\ArticleRepository;

class ArticleManager
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ArticleForm $articleForm, MetaForm $metaForm)
    {

        $article = Article::create(
            $articleForm->category_id,
            $articleForm->title,
            $articleForm->content_intro,
            $articleForm->content,
            $articleForm->slug,
            $articleForm->status,
            new Meta($metaForm->title, $metaForm->description, $metaForm->keywords));

        $this->repository->save($article);

        return $article->id;
    }

    public function getBySlug($slug)
    {
        return $this->repository->getBySlug($slug);
    }

    public function getById($id)
    {
        return $this->repository->get($id);
    }

    public function edit(ArticleForm $articleForm, MetaForm $metaForm)
    {
        /* @var $article Article
         */

        $article = $this->repository->get($articleForm->id);

        $article->edit($articleForm->category_id,
            $articleForm->title,
            $articleForm->slug,
            $articleForm->content_intro,
            $articleForm->content,
            $articleForm->publishing_at,
            new Meta($metaForm->title, $metaForm->description, $metaForm->keywords));

        $this->repository->save($article);
    }

    public function makeActive($id)
    {
        $this->repository->makeActive($id);
    }

    public function makeUnActive($id)
    {
        $this->repository->makeUnActive($id);
    }

    public function save(Article $article)
    {
        $this->repository->save($article);
    }

    public function remove($id)
    {
        $article = $this->repository->get($id);
        $this->repository->remove($article);
    }

    public function getArticlesByCategory($categoryId)
    {
        return $this->repository->getByCategoryId($categoryId);
    }

    public function getFavoriteArticles()
    {
        return $this->repository->getFavoriteArticles();
    }

}