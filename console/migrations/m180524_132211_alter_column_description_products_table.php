<?php

use yii\db\Migration;

class m180524_132211_alter_column_description_products_table extends Migration
{

    public function up()
    {
        $this->alterColumn('{{%shop_products}}', 'description', $this->text());
    }

    public function down()
    {

    }

}
