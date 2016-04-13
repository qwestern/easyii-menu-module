<?php

namespace qwestern\easyii\menu\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "easyii_menu_item".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property integer $menu_id
 * @property string  $name
 * @property string  $url
 */
class MenuItem extends \yii\db\ActiveRecord
{
    use NestedActiveRecordTrait;

    public $parent = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'easyii_menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'depth', 'tree'], 'default', 'value' => 0],
            [['name', 'url', 'lft', 'rgt', 'depth', 'menu_id'], 'required'],
            [['name', 'url'], 'string', 'max' => 255],
            [['lft', 'rgt', 'depth', 'menu_id', 'parent'], 'integer'],
        ];
    }

    public function behaviors() {
        return [
            'tree' => [
                'class'         => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree'
            ]
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'menu_id' => 'Menu ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }    
}
