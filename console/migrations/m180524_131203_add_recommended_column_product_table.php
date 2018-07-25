<?php

use yii\db\Migration;

class m180524_131203_add_recommended_column_product_table extends Migration
{

    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'recommended', $this->integer(1)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'recommended');
    }
}
