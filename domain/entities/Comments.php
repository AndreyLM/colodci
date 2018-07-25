<?php

namespace domain\entities;

use Yii;

/**
 * This is the model class for table "shop_comments".
 *
 * @property integer $id
 * @property string $user
 * @property string $email
 * @property string $message
 * @property string $subject
 */
class Comments extends \yii\db\ActiveRecord
{
    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'email', 'subject'], 'required'],
            [['user', 'email', 'message', 'subject'], 'string'],
            ['verifyCode', 'captcha']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'email' => 'Email',
            'message' => 'Message',
            'subject' => 'Subject',
        ];
    }
}
