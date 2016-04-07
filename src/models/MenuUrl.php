<?php

namespace qwestern\easyii\menu\models;

use Yii;

/**
 * This is the model class for table "easyii_menu_url".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 */
class MenuUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'easyii_menu_url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'url'], 'string', 'max' => 255],
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
            'url' => 'Url',
        ];
    }
}
