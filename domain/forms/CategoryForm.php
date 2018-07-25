<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.06.17
 * Time: 10:27
 */
namespace domain\forms;

use domain\entities\Category;
use domain\validators\SlugValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;


class CategoryForm extends Model
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $parentId;
    public $meta;

    private $_category;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['parentId'], 'integer'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['description'], 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function attributeLabels()
    {
        return [
            'parentId' => 'Родительская категория',
            'id' => 'ИД',
            'slug' => 'Псевдоним',
            'category_id' => 'Категория',
            'name' => 'Название',
            'title' => 'Полное название',
            'description' => 'Описание',
            'status' => 'Активный',

        ];
    }

}