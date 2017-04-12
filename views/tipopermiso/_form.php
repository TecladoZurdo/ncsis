<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoPermiso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-permiso-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'Tiper_Nombre')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'descuentoVacaciones')->checkbox(['uncheck'=>0,'checked'=>1]) ?>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>




    <?php ActiveForm::end(); ?>

    <title>Color de Fondo de la página</title>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
    
    
</div>
