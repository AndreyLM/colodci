<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.06.17
 * Time: 1:37
 */

namespace domain\searches;



use domain\entities\menu\Menu;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MenuSearch extends Model
{
    public $id;
    public $name;
    public $title;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'title' ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Алиас',
            'title' => 'Название',
         ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = Menu::find()->andWhere(['>', 'depth', 0]);

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
            'depth' => 1
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);
        $query
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}