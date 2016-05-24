<?php

namespace qwestern\easyii\menu\models;

use Yii;
use yii\base\Object;
use yii\helpers\ArrayHelper;
use yii\helpers\Url as YiiUrl;

class Url extends Object
{
    public $route;

    public $model;

    public $attribute;

    public $updatedAttribute;

    public $routeParam;

    /**
     * @param bool $scheme
     *
     * @return string
     */
    public function toString($scheme = false)
    {
        return YiiUrl::to([$this->route, $this->routeParam => ArrayHelper::getValue($this->model, $this->attribute)], $scheme);
    }

    /**
     * @return null|string
     */
    public function getUpdatedAt()
    {
        if (!$this->updatedAttribute) {
            return null;
        }
        return Yii::$app->formatter->asDatetime(ArrayHelper::getValue($this->model, $this->updatedAttribute), 'php:' . \DateTime::ISO8601);
    }

    public function __toString()
    {
        return $this->toString();
    }
}