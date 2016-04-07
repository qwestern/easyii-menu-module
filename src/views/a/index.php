<?php

?>

<?= \yii\helpers\Html::a('Create menu', ['create']) ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'slug',
        [
            'class' => \yii\grid\ActionColumn::className()
        ]
    ]
]); ?>
