<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PermisosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permisos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Per_Id') ?>

    <?= $form->field($model, 'Per_FechaInicio') ?>

    <?= $form->field($model, 'Per_FechaFinal') ?>

    <?= $form->field($model, 'Per_Dias') ?>

    <?= $form->field($model, 'Per_Horas') ?>

    <?php // echo $form->field($model, 'Per_Minutos') ?>

    <?php // echo $form->field($model, 'Per_Total') ?>

    <?php // echo $form->field($model, 'Per_Valor') ?>

    <?php // echo $form->field($model, 'Fun_Id') ?>

    <?php // echo $form->field($model, 'Tiper_Id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
