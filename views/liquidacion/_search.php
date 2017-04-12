<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LiquidacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="liquidacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'liq_id') ?>

    <?= $form->field($model, 'Liq_FechaInicio') ?>

    <?= $form->field($model, 'Liq_FechaFinal') ?>

    <?= $form->field($model, 'Liq_Dias') ?>

    <?= $form->field($model, 'Vac_Id') ?>

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
