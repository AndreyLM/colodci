<?php

use yii\db\Migration;

class m180609_081853_add_properties_contact_table extends Migration
{

    public function up()
    {
        $this->addColumn('{{%shop_contacts}}', 'type', $this->integer(1)->defaultValue(0));
        $this->addColumn('{{%shop_contacts}}', 'position', $this->integer(3)->defaultValue(0));

    }

    public function down()
    {
        $this->dropColumn('{{%shop_contacts}}', 'type');
        $this->dropColumn('{{%shop_contacts}}', 'position');
    }

}
