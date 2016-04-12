<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace qwestern\easyii\menu\assets;

use yii\web\AssetBundle;

class MenuAsset extends AssetBundle
{
    public $sourcePath = '@vendor/qwestern/easyii-menu-module/src/assets/src';

    public $css = [
        'menu.css',
    ];

    public $depends = [
        'yii\jui\JuiAsset',
    ];
}
