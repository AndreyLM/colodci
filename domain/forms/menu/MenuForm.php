<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms\menu;


use domain\entities\menu\Menu;
use yii\base\Model;



class MenuForm extends Model
{
    public $id;
    public $title;
    public $name;
    public $status;
    public $type;

    public function __construct(Menu $menu = null, array $config = [])
    {
        if($menu) {
            $this->id = $menu->id;
            $this->title = $menu->title;
            $this->name = $menu->name;
            $this->status = $menu->status;
            $this->type = Menu::MENU_TYPE_MENU;
        }


        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
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
            'status' => 'Статус',
        ];
    }
}