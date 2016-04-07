<?php

namespace qwestern\easyii\menu\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "easyii_menu_item".
 *
 * @property integer $id
 * @property integer $menu_url_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $menu_id
 */
class MenuItem extends \yii\db\ActiveRecord
{
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
            [['menu_url_id', 'lft', 'rgt', 'depth', 'menu_id'], 'required'],
            [['menu_url_id', 'lft', 'rgt', 'depth', 'menu_id'], 'integer'],
        ];
    }
    
    public function behaviors()
    {
        return [
            'tree' => [
            'class' => NestedSetsBehavior::className(),
            'treeAttribute' => 'tree'
        ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_url_id' => 'Menu Url ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItem()
    {
        return $this->hasOne(MenuUrl::className(), ['id' => 'menu_url_id']);
    }

    
}
