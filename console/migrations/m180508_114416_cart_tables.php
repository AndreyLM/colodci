<?php

use yii\db\Schema;
use yii\db\Migration;

class m180508_114416_cart_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%shop_order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'phone' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_TEXT,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->createTable('{{%shop_order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'price' => Schema::TYPE_MONEY,
            'product_id' => Schema::TYPE_INTEGER,
            'quantity' => Schema::TYPE_FLOAT,
        ], $tableOptions);

        $this->addForeignKey('fk-shop_order_item-shop_order_id-order-id', '{{%shop_order_item}}', 'order_id', '{{%shop_order}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-shop_order_item-shop_product_id-product-id', '{{%shop_order_item}}', 'product_id', '{{%shop_products}}', 'id', 'SET NULL');
    }

    public function down()
    {


        $this->dropTable('{{%shop_order_item}}');
        $this->dropTable('{{%shop_order}}');
    }
}
