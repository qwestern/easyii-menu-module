<?php

namespace qwestern\easyii\menu\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\easyii\behaviors\CacheFlush;

/**
 * This is the model class for table "easyii_menu_item".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property string  $name
 * @property string  $route_string
 */
class MenuItem extends \yii\db\ActiveRecord
{
    use NestedActiveRecordTrait;

    const CACHE_KEY = 'menu_item';

    public $parent = null;

    protected $url;

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
            [['name', 'url', 'lft', 'rgt', 'depth'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['url', 'route_string'], 'safe'],
            [['lft', 'rgt', 'depth', 'parent'], 'integer'],
        ];
    }

    public function getUrl()
    {
        return is_array(json_decode($this->route_string, true)) ? json_decode($this->route_string, true) : $this->route_string;
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class'         => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree'
            ],
            [
                'class' => CacheFlush::className(),
                'key' => [['yii\widgets\FragmentCache', 'menu_item']]
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
            'url' => 'Url / item',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
        ];
    }

    public function attributeHints()
    {
        return [
            'url' => 'Can contain URL in form of http://google.com or item selected from list'
        ];
    }
}
