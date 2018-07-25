<?php

namespace domain\searches;

use domain\entities\Article;
use domain\entities\Category;
use domain\helpers\ArticleHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ArticleSearch extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $created_at;
    public $publishing_at;
    public $slug;
    public $status;


    public function rules()
    {
        return [
            [['id', 'category_id', 'status'], 'integer'],
            [['title', 'created_at', 'publishing_at', 'slug'], 'safe'],
//            [['created_at', 'publishing_at'], 'date'],
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

    public function search(array $params)
    {
        $query = Article::find()->with('category');//->leftJoin('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['publishing_at' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'publishing_at'=> $this->publishing_at
        ]);

        $query
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return ArticleHelper::statusList();
    }
}