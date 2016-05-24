<?php

use kartik\typeahead\Typeahead;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model qwestern\easyii\menu\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */

$urls = array_map(function ($url) {
    return $url->toString();
}, Yii::$app->routes->getAll());
?>

<div class="menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'url')->widget(Typeahead::classname(), [
        'dataset' => [
            [
                'local' => $urls,
                'limit' => 10
            ]
        ],
        'pluginOptions' => ['highlight' => true],
        'options' => ['placeholder' => 'Start with /'],
    ]) ?>

    <?= $model->isNewRecord ? $form->field($model, 'parent')->dropDownList(ArrayHelper::merge(['' => 'No parent'], ArrayHelper::map($children, 'primaryKey', 'name'))) : '' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
