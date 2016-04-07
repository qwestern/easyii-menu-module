<?php
namespace qwestern\easyii\menu\models;

use Yii;
use yii\behaviors\SluggableBehavior;

class Menu extends \yii\easyii\components\ActiveRecord {
    public static function tableName()
    {
        return 'easyii_menu';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['slug'], 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            [['slug'], 'unique'],
        ];
    }
    public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true
            ]
        ];
    }


}