<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model qwestern\easyii\menu\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */

// contains urls in form of "json encoded route" => "Item title (Item type)"
$urlData = [];

foreach (Yii::$app->routes->getAll() as $url) {
    if ($url->model) {
        $urlData[json_encode([$url->route, $url->routeParam => ArrayHelper::getValue($url->model, $url->attribute)])] = ArrayHelper::getValue($url->model, $url->titleAttribute, ArrayHelper::getValue($url->model, $url->attribute)) . ' (' . $url->name . ')';
        continue;
    }
    $urlData[json_encode([$url->route])] = $url->name;
}
?>

<div class="menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'route_string')->widget(Select2::className(), [
        'data' => $urlData,
        'options' => ['placeholder' => 'Click here to select ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
        ],
    ]); ?>

    <?= $model->isNewRecord ? $form->field($model, 'parent')->dropDownList(ArrayHelper::merge(['' => 'No parent'], ArrayHelper::map($children, 'primaryKey', 'name'))) : '' ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
