<?php

namespace domain\entities;

use domain\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content_intro
 * @property string $content
 * @property int $created_at
 * @property int $publishing_at
 * @property string $slug
 * @property integer $status
 * @property Meta $meta
 * @property Category $category
 */
class Article extends ActiveRecord
{
    public $meta;
    const UN_ACTIVE = 0;
    const ACTIVE = 1;

    public static function create($category_id, $title, $content_intro, $content, $slug, $status, Meta $meta): self
    {
        $article = new static();
        $article->category_id = $category_id;
        $article->title = $title;
        $article->content_intro = $content_intro;
        $article->content = $content;
        $article->created_at = time();
        $article->publishing_at = time();
        $article->slug = $slug;
        $article->status = $status;
        $article->meta = $meta;
        return $article;
    }

    public function edit($category_id, $title, $slug, $content_intro, $content, $publishing_at, Meta $meta): void
    {
        $this->category_id = $category_id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content_intro = $content_intro;
        $this->content = $content;
        $this->publishing_at = $publishing_at;
        $this->meta = $meta;
    }

    public function getSeoTitle()
    {
        return $this->meta->title ?: $this->title;
    }

    public static function tableName()
    {
        return '{{%shop_articles}}';
    }

    public function behaviors()
    {
        return [
            MetaBehavior::className(),
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function makeActive()
    {
        $this->status = self::ACTIVE;
    }

    public function makeUnActive()
    {
        $this->status = self::UN_ACTIVE;
    }

    public function isActive()
    {
        return $this->status === self::ACTIVE;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


}