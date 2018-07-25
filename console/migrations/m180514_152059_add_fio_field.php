<?php

use yii\db\Migration;

class m180514_152059_add_fio_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_order}}', 'fio', 'VARCHAR(64) AFTER id');
    }

    public function down()
    {
        $this->dropColumn('{{%shop_order}}', 'fio');
    }
}
