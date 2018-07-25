<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms;

use domain\entities\Article;
use domain\entities\Category;
use domain\validators\SlugValidator;
use yii\base\Model;



class ArticleForm extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $content_intro;
    public $content;
    public $created_at;
    public $publishing_at;
    public $status;
    public $slug;

    public function __construct(Article $article = null, array $config = [])
    {
        if($article) {
            $this->id = $article->id;
            $this->category_id = $article->category_id;
            $this->title = $article->title;
            $this->content_intro = $article->content_intro;
            $this->content = $article->content;
            $this->created_at = $article->created_at;
            $this->publishing_at = $article->publishing_at;
            $this->status = $article->status;
            $this->slug = $article->slug;
        }

        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['title', 'slug', 'content_intro'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['content_intro', 'content'], 'string'],
            [['created_at', 'publishing_at'], 'integer'],
            ['slug', SlugValidator::class],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'category_id' => 'Категория',
            'title' => 'Название',
            'created_at' => 'Дата создания',
            'publishing_at' => 'Дата публикации',
            'status' => 'Активный',
            'slug' => 'Псевдоним',
        ];
    }

}