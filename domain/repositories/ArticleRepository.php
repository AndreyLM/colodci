<?php

namespace domain\repositories;

use domain\entities\Article;
use domain\NotFoundException;

class ArticleRepository
{

    public function __construct()
    {

    }

    public function getBySlug($slug)
    {
        if (!$article = Article::findOne(['slug'=>$slug])) {
            throw new NotFoundException('Article is not found');
        }

        return $article;
    }

    public function get($id)
    {
        if (!$article = Article::findOne($id)) {
            throw new NotFoundException('Article is not found.');
        }
        return $article;
    }

    public function getByCategoryId($id)
    {
        if(!$articles = Article::find()->where(['category_id' => $id])->all())
        {
            throw  new NotFoundException('Articles are not found');
        }

        return $articles;
    }

    public function save(Article $article)
    {
        if (!$article->save()) {
            throw new \RuntimeException('Saving error.');
        }

        return $article->id;
    }

    public function makeActive($id)
    {
        $article = $this->get($id);
        if ($article->isActive()) {
            return ;
        }

        $article->makeActive();

        $article->save();
    }

    public function makeUnActive($id)
    {
        $article = $this->get($id);
        if (!$article->isActive()) {
            return ;
        }

        $article->makeUnActive();

        $article->save();
    }

    public function remove(Article $article)
    {
        if (!$article->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}