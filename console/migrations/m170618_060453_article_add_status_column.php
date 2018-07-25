<?php

use yii\db\Migration;

class m170618_060453_article_add_status_column extends Migration
{

    public function up()
    {
        $this->addColumn('{{%shop_articles}}', 'status', $this->integer(1)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('{{%shop_articles}}', 'status');
    }

}
