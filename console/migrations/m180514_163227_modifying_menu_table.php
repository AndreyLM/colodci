<?php

use yii\db\Migration;

class m180514_163227_modifying_menu_table extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->dropTable('{{%shop_menus}}');

        $this->createTable('{{%shop_menus}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'status' => $this->integer(1)->defaultValue(0)
        ], $tableOptions);

        $this->insert('{{%shop_menus}}', [
            'id' => 1,
            'name' => 'root',
            'title' => 'Root menu',
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
