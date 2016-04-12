<?php
namespace qwestern\easyii\menu\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use \yii\easyii\components\ActiveRecord;

/**
 * This is the model class for table "easyii_menu".
 *
 * @property string $name
 * @property string $slug
 */
class Menu extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'easyii_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['slug'], 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
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
