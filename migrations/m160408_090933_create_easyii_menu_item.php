<?php

use yii\db\Migration;

class m160408_090933_create_easyii_menu_item extends Migration
{
    public function up()
    {
        $this->createTable('easyii_menu_item', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'menu_id' => $this->integer()->notNull(),

        ]);
    }

    public function down()
    {
        $this->dropTable('easyii_menu_item');
    }
}
