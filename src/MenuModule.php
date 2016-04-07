<?php
namespace qwestern\easyii\menu;


use yii\easyii\components\Module;

class MenuModule extends Module{
    public static $installConfig = [
        'title' => [
            'en' => 'Menu',
            'ru' => 'Test',
        ],
        'icon' => 'file',
        'order_num' => 99,
    ];
}