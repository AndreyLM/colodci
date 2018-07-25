<?php

namespace domain\entities;

use domain\forms\ContactForm;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $text
 * @property integer $type
 * @property integer $position
 * @property string $url
*/

class Contact extends ActiveRecord
{
    const CONTACT_TYPE_SOCIAL = 0;
    const CONTACT_TYPE_PHONES = 1;


    public static function create(ContactForm $contactForm): self
    {
        $contact = new static();

        $contact->text = $contactForm->text;
        $contact->type = $contactForm->type;
        $contact->position = $contactForm->position;
        $contact->url = $contactForm->url;

        return $contact;
    }

    public function edit(ContactForm $contactForm): void
    {
        $this->text = $contactForm->text;
        $this->url = $contactForm->url;
        $this->type = $contactForm->type;
        $this->position = $contactForm->position;
    }

    public static function tableName()
    {
        return '{{%shop_contacts}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'text' => 'Текст',
            'type' => 'Тип',
            'position' => 'Позиция',
            'url' => 'Url'
        ];
    }

    public function getCurrentType()
    {
        $arr = self::getTypes();

        return $arr[$this->type];
    }

    public static function getTypes()
    {
        return [
            self::CONTACT_TYPE_SOCIAL => 'Социальные ссылки',
            self::CONTACT_TYPE_PHONES => 'Телефоны, графики роботы и т.д.',
        ];
    }
}