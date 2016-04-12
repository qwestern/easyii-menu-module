<?php

class m000000_000001_install extends \yii\db\Migration {

    public function up()
    {
        $this->createTable('easyii_menu', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('easyii_menu');
    }
}