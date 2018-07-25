<?php

use yii\db\Migration;

class m170622_123023_shop_menu_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_menus}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%shop_menus}}', [
            'id' => 0,
            'name' => 'root',
            'type' => 0,
            'related_id' => 0,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);


    }

    public function down()
    {
        $this->dropTable('{{%shop_menus}}');
    }
}
