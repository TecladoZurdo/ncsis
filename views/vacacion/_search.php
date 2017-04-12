<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Vac_Id') ?>

    <?= $form->field($model, 'Vac_FechaInicio') ?>

    <?= $form->field($model, 'Vac_FechaFinal') ?>

    <?= $form->field($model, 'Vac_Dias') ?>

    <?= $form->field($model, 'Fun_Id') ?>

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
