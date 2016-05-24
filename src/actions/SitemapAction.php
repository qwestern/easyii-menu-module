<?php

namespace qwestern\easyii\menu\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;

class SitemapAction extends Action
{

    public $view = '@qwestern/easyii/menu/views/sitemap';

    public function run()
    {
        $this->controller->layout = false;
        $response = Yii::$app->response;

        $response->format = Response::FORMAT_XML;
        $response->content = $this->controller->render($this->view, ['urls' => Yii::$app->routes->getAll()]);

        return $response;
    }
}
