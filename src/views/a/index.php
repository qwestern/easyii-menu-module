<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */
?>

<?= Html::a('Create menu', ['create']) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name' => [
            'attribute' => 'name',
            'value' => function ($model) {
                return Html::a($model->name, ['/admin/menu/item', 'id' => $model->primaryKey]);
            },
            'format' => 'html',
        ],
        'slug' => [
            'label' => 'Slug',
            'attribute' => 'url',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}'
        ]
    ]
]);
