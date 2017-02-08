<?php

namespace qwestern\easyii\menu\routes;

use app\extensions\articles\models\Item;
use qwestern\easyii\menu\models\Url;
use traffic\easyii\lender\models\Lender;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class Route extends Component
{

    /**
     * @example
     * For route with no entities: ['route' => '/blog/index'],
     * Route with entities:
     *
     * 'yii\easyii\modules\article\models\Item' => [ // FQ classname
     *   'route' => '/blog/view', // urlManager route
     *   'attribute' => 'slug', // model slug attribute
     *   'routeParam' => 'slug' // route slug attribute
     *   'updatedAttribute' => 'time', // last update model param
     *  ],
     *
     * @var array
     */
    public $classes = [];

    /**
     * @return Url[]
     */
    public function getAll()
    {
        $urls = [];

        $urlManagerRoutes = ArrayHelper::getColumn(Yii::$app->urlManager->rules, 'route');

        foreach ($this->classes as $class => $options) {
            if (is_integer($class)) {
                if (!in_array(preg_replace('/^\//', '', $options['route']), $urlManagerRoutes)) {
                    continue;
                }
                $urls[] = new Url($options);
                continue;
            }

            $models = call_user_func([$class, 'find'])->all();

            $models = array_filter($models, function ($item) {
                return (!$item instanceof Lender && !$item instanceof Item)
                ||
                ($item instanceof Item && isset($item->published) && $item->published !== null)
                ||
                ($item instanceof Lender && isset($item->status) && $item->status != 0) ;
            });

            $urls = ArrayHelper::merge($urls, array_map(function ($item) use ($options) {
                return new Url(ArrayHelper::merge($options, [
                    'model' => $item
                ]));
            }, $models));
        }
        return $urls;
    }
}
