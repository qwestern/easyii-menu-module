<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $model \qwestern\easyii\menu\models\MenuItem; */

$childrenDataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $model->getChildren()
]);
?>

    <div class="sortable-item-content" data-linkid="<?= $model->primaryKey ?>">

        <div class="pull-left">
            <b><?= $model->name ?></b><br/>
            <span class="menu-link"><?= (empty($model->url) ? "(no link)" : "[{$model->url}]") ?></span>
        </div>
        <div class="menu-link-actions">
            <?= Html::a('[' . Yii::t('app', 'Edit') . ']', ['/menu/link/update', 'id' => $model->primaryKey], ['data-pjax' => 0]) ?>
            <br/>
            <?= Html::a(
                '[' . Yii::t('app', 'Delete') . ']', ['/menu/link/delete', 'id' => $model->primaryKey], [
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method'  => 'post',
                    'data-pjax'    => '0',
                ]
            ) ?>
        </div>

    </div>
    <span class="sortable-drag-icon glyphicon glyphicon-move"></span>

    <?= $this->render('links', ['dataProvider' => $childrenDataProvider]) ?>