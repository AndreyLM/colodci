<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/15/18
 * Time: 10:43 AM
 */

namespace domain\forms\menu;

use domain\entities\menu\Menu;
use yii\base\Model;

class MenuItemForm extends Model
{
    public $id;
    public $name;
    public $title;
    public $type;
    public $status;
    public $relation;
    public $depth;
    public $parentId;

    public function __construct(Menu $item = null, array $config = [])
    {
        if($item) {
            $this->id = $item->id;
            $this->title = $item->title;
            $this->name = $item->name;
            $this->status = $item->status;
            $this->type = $item->type;
            $this->relation = $item->related_id;
        }


        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'parentId'], 'required'],
            [['type', 'relation', 'depth', 'status', 'parentId'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 32],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'title' => 'Название',
            'name' => 'Алиас',
            'type' => 'Тип',
            'relation' => 'Связь',
            'depth' => 'Depth',
            'status' => 'Статус',
            'parentId' => 'Родительский элемент',
        ];
    }

    public function getItemTypes()
    {
        $types = Menu::getTypes();

        return $types;
    }
}