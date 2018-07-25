<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.06.17
 * Time: 1:37
 */

namespace domain\searches;


use domain\entities\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $title;
    public $description;

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
            'description' => 'Описание',
            'status' => 'Активный',
            'slug' => 'Псевдоним',
            'code' => 'Код',
            'price' => 'Цена',

        ];
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'title', 'description'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = Category::find()->andWhere(['>', 'depth', 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['lft' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}