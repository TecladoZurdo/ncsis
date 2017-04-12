<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Vacacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacacion-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?php echo Html::activeHiddenInput($model, 'Fun_Id'); ?>
            <?php
            echo Html::label('Busqueda Funcionario');
            if ($model->isNewRecord)
                echo Html::textInput('funcionario', '', ['id' => 'funcionario', 'class' => 'form-control']);
            else
                echo Html::textInput('funcionario', $funcionario->Fun_Cedula, ['id' => 'funcionario', 'class' => 'form-control']);

            echo Html::label('Funcionario Nombre Completo');
            if ($model->isNewRecord)
                echo Html::textInput('Fun_Nombre', '', ['id' => 'Fun_Nombre', 'class' => 'form-control', 'readonly' => 'readonly']);
            else
                echo Html::textInput('Fun_Nombre', $funcionario->Fun_Nombres . " " . $funcionario->Fun_Apellidos, ['id' => 'Fun_Nombre', 'class' => 'form-control', 'readonly' => 'readonly']);


            
            echo Html::label('Total de Vacaciones');

            echo Html::textInput('vac_acu', '', ['id' => 'vac_acu', 'class' => 'form-control', 'readonly' => 'readonly']);

            
            ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'Vac_FechaInicio')->textInput() ?>

            <?= $form->field($model, 'Vac_FechaFinal')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Vac_DiasCal')->textInput(['maxlength' => true]) ?>

            
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $url = Url::base() . '@web/js/form_vacacion.js';
    $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
    ?>

    
    
<style type="text/css">
body{
	background:khaki;
   
}
</style>
    

</div>
