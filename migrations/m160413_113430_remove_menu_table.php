<?php

use yii\db\Migration;

class m160413_113430_remove_menu_table extends Migration
{
    public function up()
    {
        $this->dropColumn('easyii_menu_item', 'menu_id');
        $this->dropTable('easyii_menu');
    }

    public function down()
    {
        $this->createTable('easyii_menu', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()
        ]);
        $this->addColumn('easyii_menu_item', 'menu_id', $this->integer()->notNull());
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
