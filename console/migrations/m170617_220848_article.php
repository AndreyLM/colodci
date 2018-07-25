<?php

use yii\db\Migration;

class m170617_220848_article extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_articles}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content_intro' => $this->text(),
            'content' => $this->text(),
            'created_at' => $this->integer(),
            'publishing_at' => $this->integer(),
            'meta_json' => $this->string(),

        ], $tableOptions);

        $this->createIndex('{{%idx-shop_article-slug}}', '{{%shop_articles}}', 'slug', true);
        $this->addForeignKey('{{%fk_article_category}}', '{{%shop_articles}}', 'category_id',
            '{{%shop_categories}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%shop_articles}}');
    }
}
