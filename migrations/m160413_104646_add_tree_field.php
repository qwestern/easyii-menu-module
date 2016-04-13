<?php

use yii\db\Migration;

class m160413_104646_add_tree_field extends Migration
{
    public function up()
    {
         $this->addColumn('easyii_menu_item', 'tree', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('easyii_menu_item', 'tree');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
