<?php

 use yii\db\Migration;

 class  m170621_075415_add_product_fields extends Migration
 {
     public function up()
     {
         $this->addColumn('{{%shop_products}}', 'main_photo_id', $this->integer());
         $this->addColumn('{{%shop_products}}', 'publishing_at', $this->integer());
         $this->addColumn('{{%shop_products}}', 'title', $this->string());
         $this->addColumn('{{%shop_products}}', 'status', $this->integer()->defaultValue(1));
         $this->addColumn('{{%shop_products}}', 'order', $this->integer());


         $this->createIndex('{{%idx-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id');

         $this->addForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}', 'main_photo_id', '{{%shop_photos}}', 'id', 'SET NULL', 'RESTRICT');
     }

     public function down()
     {
         $this->dropForeignKey('{{%fk-shop_products-main_photo_id}}', '{{%shop_products}}');

         $this->dropColumn('{{%shop_products}}', 'main_photo_id');
         $this->dropColumn('{{%shop_products}}', 'publishing_at');
         $this->dropColumn('{{%shop_products}}', 'title');
         $this->dropColumn('{{%shop_products}}', 'status');
         $this->dropColumn('{{%shop_products}}', 'order');
     }
 }
