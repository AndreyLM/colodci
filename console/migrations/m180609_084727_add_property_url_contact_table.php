<?php

use yii\db\Migration;

class m180609_084727_add_property_url_contact_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_contacts}}', 'url',
            $this->string()->defaultValue('#'));


    }

    public function down()
    {
        $this->dropColumn('{{%shop_contacts}}', 'type');
    }
}
