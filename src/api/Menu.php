<?php 

namespace qwestern\easyii\menu\api;
use qwestern\easyii\menu\models\MenuItem;
use yii\helpers\Inflector;
use yii\widgets\Menu as MenuWidget;

/**
*
*/
class Menu extends \yii\easyii\components\API
{
    public function api_items($slug)
    {
        $menu = MenuItem::find()->where(['route_string'=>$slug])->one();
        if (!$menu) {
            $menuItem = new MenuItem([
                'name' => Inflector::humanize($slug),
                'url' => $slug
            ]);
            $menuItem->makeRoot();
        }

        return $this->formatItem($menu ? $menu->children : []);
    }

    public function api_menu($slug)
    {
        return MenuWidget::widget([
            'items' => $this->api_items($slug)
        ]);
    }

    private function formatItem($items)
    {
        $ret=[];
        foreach ($items as $item) {
            $retItem = [
                'label' => $item->name,
                'url' => $item->url,
            ];
            if (count($item->children)) {
                $retItem['items'] = $this->formatItem($item->children);
            }

            $ret[]=$retItem;
        }
        return $ret;
    }
}
