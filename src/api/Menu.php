<?php 

namespace qwestern\easyii\menu\api;
use qwestern\easyii\menu\models\MenuItem;
use yii\widgets\Menu as MenuWidget;

/**
*
*/
class Menu extends \yii\easyii\components\API
{
    public function api_items($slug)
    {
        $menu = MenuItem::find()->where(['url'=>$slug])->one();

        return $this->formatItem($menu->children);
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
            $ret[]=[
                'label' => $item->name,
                'url' => $item->url,
                'items' => $this->formatItem($item->children)
            ];
        }
        return $ret;
    }
}
