<?php

namespace qwestern\easyii\menu\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "easyii_menu_item".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property string  $name
 * @property string  $url
 */
class Menu extends MenuItem
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::className(),
                'slugAttribute' => 'url',
                'attribute' => 'name',
            ],
        ]);
    }

    public function rules()
    {
        return [
            [['lft', 'rgt', 'depth', 'tree'], 'default', 'value' => 0],
            [['name', 'lft', 'rgt', 'depth'], 'required'],
            [['name', 'url'], 'string', 'max' => 255],
            [['lft', 'rgt', 'depth', 'parent'], 'integer'],
            [['url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Slug',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
        ];
    }

    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::className(), ['menu_id' => 'id']);
    }

    public function getRoots()
    {
        return $this->getMenuItems()->roots();
    }
}
