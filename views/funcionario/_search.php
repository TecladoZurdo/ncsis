<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FuncionarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Fun_Id') ?>

    <?= $form->field($model, 'Fun_Codigo') ?>

    <?= $form->field($model, 'Fun_Cedula') ?>

    <?= $form->field($model, 'Fun_Nombres') ?>

    <?= $form->field($model, 'Fun_Apellidos') ?>

    <?php // echo $form->field($model, 'Fun_FechaIngreso') ?>

    <?php // echo $form->field($model, 'Fun_Estado') ?>

    <?php // echo $form->field($model, 'Fun_VacAcumuladas') ?>

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
