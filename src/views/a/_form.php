<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var qwestern\easyii\menu\models\Menu $model
 */
/**
 * @var integer
 */
$module = $this->context->module->id;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'name') ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end();