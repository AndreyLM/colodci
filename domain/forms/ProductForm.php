<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.06.17
 * Time: 10:09
 */

namespace domain\forms;


use domain\entities\Category;
use domain\entities\Product;
use yii\base\Model;

class ProductForm extends Model
{
    public $id;
    public $category_id;
    public $created_at;
    public $publishing_at;
    public $code;
    public $name;
    public $title;
    public $description;
    public $price;
    public $status;
    public $order;
    public $recommended;


    public function __construct(Product $product = null, array $config = [])
    {
        if ($product) {
            $this->id = $product->id;
            $this->category_id = $product->category_id;
            $this->created_at = $product->created_at;
            $this->publishing_at = $product->publishing_at;
            $this->code = $product->code;
            $this->name = $product->name;
            $this->title = $product->title;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->status = $product->status;
            $this->recommended = $product->recommended;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        $rules = [
            [['title', 'category_id', 'code', 'name', 'price'], 'required'],
            [['category_id', 'status', 'code', 'order', 'recommended'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['created_at', 'publishing_at'], 'integer'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id']
        ];

        if(!$this->id) {
            $rules[] = [['code'], 'unique', 'targetClass' => Product::class, 'targetAttribute' => 'code'];
        }

        return $rules;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'category_id' => 'Категория',
            'name' => 'Название',
            'title' => 'Полное название',
            'content_intro' => 'Интро текст',
            'content' => 'Текст',
            'created_at' => 'Дата создания',
            'publishing_at' => 'Дата публикации',
            'status' => 'Активный',
            'slug' => 'Псевдоним',
            'code' => 'Код',
            'price' => 'Цена',
            'recommended' => 'Рекомендованый'

        ];
    }
}