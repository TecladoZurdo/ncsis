<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CalculoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calculo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Cal_Id') ?>

    <?= $form->field($model, 'Cal_FechaInicio') ?>

    <?= $form->field($model, 'Cal_FechaFin') ?>

    <?= $form->field($model, 'Cal_Dias') ?>

    <?= $form->field($model, 'Cal_Anio') ?>

    <?php // echo $form->field($model, 'Fun_Id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<style type="text/css">
body{
	body{
	background:khaki;
}
}
</style>
</div>
