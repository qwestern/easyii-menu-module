<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $model \qwestern\easyii\menu\models\MenuItem; */

$childrenDataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $model->getChildren()
]);
$module = $this->context->module->id;
?>

    <div class="sortable-item-content" data-linkid="<?= $model->primaryKey ?>">

        <div class="pull-left">
            <b><?= $model->name ?></b><br/>
            <span class="menu-link"><?= \yii\helpers\Url::to($model->url) ?></span>
        </div>
        <div class="menu-link-actions">
            <?= Html::a('[' . Yii::t('app', 'Edit') . ']', ['/admin/'. $module .'/item/update', 'id' => $model->primaryKey], ['data-pjax' => 0]) ?>
            <br/>
            <?= Html::a(
                '[' . Yii::t('app', 'Delete') . ']', ['/admin/'. $module .'/item/delete', 'id' => $model->primaryKey], [
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method'  => 'post',
                    'data-pjax'    => '0',
                ]
            ) ?>
        </div>

    </div>
    <span class="sortable-drag-icon glyphicon glyphicon-move"></span>

    <?= $this->render('links', ['dataProvider' => $childrenDataProvider]) ?>