<?php
use yii\widgets\ListView;
/* @var $this yii\web\View */
?>

<?= ListView::widget([
    'id' => 'menu-link-grid',
    'showOnEmpty' => true,
    'dataProvider' => $dataProvider,
    'layout' => "{items}",
    'options' => [
        'tag' => 'ul',
        'class' => 'sortable',
        #'data-parentid' => (isset($parentId) ? $parentId : null)
    ],
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'sortable-item',
    ],
    'itemView' => function ($model) {
        return $this->render('link', ['model' => $model]);
    },
]) ?>