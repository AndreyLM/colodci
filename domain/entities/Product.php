<?php

namespace domain\entities;

use domain\entities\behaviors\MetaBehavior;
use domain\forms\MetaForm;
use domain\forms\ProductForm;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "shop_products".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $publishing_at
 * @property string $code
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property string $meta_json
 * @property integer $status
 * @property integer $recommended
 * @property integer $order
 * @property integer $main_photo_id
 * @property Meta $meta
 *
 * @property Photo[] $photos
 * @property Category $category
 *
 */
class Product extends ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;


    public $meta;
    const ACTIVE = 1;
    const UN_ACTIVE = 0;
    const RECOMMENDED = 1;
    const UNRECOMMENDED = 0;

    public static function create(ProductForm $productForm, MetaForm $metaForm)
    {
        $product = new static();
        $product->category_id = $productForm->category_id;
        $product->created_at = time();
        $product->publishing_at = time();
        $product->code = $productForm->code;
        $product->name = $productForm->name;
        $product->title = $productForm->title;
        $product->description = $productForm->description;
        $product->price = $productForm->price;
        $product->order = $productForm->order;
        $product->status = $productForm->status;
        $product->recommended = $productForm->recommended;

        $product->meta = new Meta($metaForm->title, $metaForm->description, $metaForm->keywords);

        return $product;
    }

    public function edit(ProductForm $productForm, MetaForm $metaForm)
    {
        $this->category_id = $productForm->category_id;
        $this->created_at = $productForm->created_at;
        $this->publishing_at = $productForm->publishing_at;
        $this->code = $productForm->code;
        $this->name = $productForm->name;
        $this->title = $productForm->title;
        $this->description = $productForm->description;
        $this->price = $productForm->price;
        $this->order = $productForm->order;
        $this->status = $productForm->status;
        $this->recommended = $productForm->recommended;

        $this->meta = new Meta($metaForm->title, $metaForm->description, $metaForm->keywords);
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

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public static function tableName()
    {
        return '{{%shop_products}}';
    }

    public function behaviors()
    {

        return [
            MetaBehavior::className(),
        ];
    }

    public function getMainPhoto()
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    public function addPhoto(UploadedFile $file)
    {
        $photo = Photo::create($file, $this->id);
        $photo->save();
    }

    public function removePhoto($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                $photo_del = Photo::findOne($id);
                $photo_del->delete();
                $photo_del->save();
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i] = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }


    public function isActive()
    {
        return $this->status === self::ACTIVE;
    }

    public function makeActive()
    {
        $this->status = self::ACTIVE;
    }

    public function makeUnActive()
    {
        $this->status = self::UN_ACTIVE;
    }

    public function isRecommended()
    {
        return $this->recommended === self::RECOMMENDED;
    }

    public function makeRecommended()
    {
        $this->recommended = self::RECOMMENDED;
    }

    public function makeUnRecommended()
    {
        $this->recommended = self::UNRECOMMENDED;
    }


    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

}
