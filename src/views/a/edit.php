<?php

/**
 * @var qwestern\easyii\menu\models\Menu $model
 */

$this->title = Yii::t('easyii/menu', 'Edit menu');
?>
<?= $this->render('_form', ['model' => $model]);
