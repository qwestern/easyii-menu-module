<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 */
?>

<?= Html::a('Create menu', ['create']) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'slug',
        [
            'class' => ActionColumn::className()
        ]
    ]
]);
