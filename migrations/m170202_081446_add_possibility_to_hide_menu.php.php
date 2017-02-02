<?php

use yii\db\Migration;

class m170202_081446_add_possibility_to_hide_menu extends Migration
{
    public function up()
    {
        $this->addColumn('easyii_menu_item', 'is_active', $this->smallInteger()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('easyii_menu_item', 'is_active');
    }
}
