<?php

namespace domain\searches;

use domain\entities\Product;

use domain\helpers\ProductHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ProductSearch extends Model
{
    public $id;
    public $category_id;
    public $code;
    public $name;
    public $title;
    public $price;
    public $status;
    public $recommended;
    public $created_at;

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'category_id' => 'Категория',
            'title' => 'Название',
            'content_intro' => 'Интро текст',
            'content' => 'Текст',
            'created_at' => 'Дата создания',
            'publishing_at' => 'Дата публикации',
            'status' => 'Активный',
            'recommended' => 'Рекомендуемые',
            'slug' => 'Псевдоним',
            'code' => 'Код',
            'price' => 'Цена',

        ];
    }

    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'recommended', 'code'], 'integer'],
            [['title', 'name', 'price'], 'safe'],
//            [['created_at', 'publishing_at'], 'date'],
        ];
    }

    public function search(array $params)
    {
        $query = Product::find()->with('category');//->leftJoin('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
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
            'code'=> $this->code,
            'status' => $this->status,
            'recommended' => $this->recommended,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return ProductHelper::statusList();
    }

    public function recommendedList(): array
    {
        return ProductHelper::recommendedList();
    }
}