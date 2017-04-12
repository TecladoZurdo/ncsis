<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Liquidacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="liquidacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Liq_FechaInicio')->textInput() ?>

    <?= $form->field($model, 'Liq_FechaFinal')->textInput() ?>

    <?= $form->field($model, 'Liq_Dias')->textInput() ?>

    <?= $form->field($model, 'Vac_Id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <title>Color de Fondo de la página</title>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>
