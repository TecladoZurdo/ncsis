<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Permisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permisos-form">

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
            
            
            echo Html::label('Días de Vacaciones Registradas Calendario');

            echo Html::textInput('vac_acu_cal', '', ['id' => 'vac_acu_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
            
            echo Html::label('Días de Vacaciones Registradas Laborables');

            echo Html::textInput('vac_acu_lab', '', ['id' => 'vac_acu_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
            
            //echo Html::label('Días de Vacación al Momento');

            //echo Html::textInput('vac_cal', '', ['id' => 'vac_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
            ?>
            
            
            
            <?= $form->field($model, 'Tiper_Id')->dropDownList($model->getListaPermisos(), ['prompt' => 'Seleccione']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'Per_FechaInicio')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Per_FechaFinal')->textInput(['maxlength' => true]) ?>
            
                <!-- y en la caja de texto le quite la opcion readonly   ['readonly' => 'readonly'] que hace   
                que la caja de texto sea solo de lectura -->
                
            <?= $form->field($model, 'Per_Dias')->textInput() ?>

            <?= $form->field($model, 'Per_Horas')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Per_Minutos')->textInput(['maxlength' => true]) ?>

            
  
                
            <?= $form->field($model, 'Per_Total')->textInput(['readonly' => 'readonly']) ?>
            <?= $form->field($model, 'Per_ValorLab')->hiddenInput (['value'=>0,''])->label(false) ?>   

        </div>


    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



    <?php ActiveForm::end(); ?>
    <?php
    $url = Url::base() . '@web/js/form_permisos.js';
    $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
    ?>
    

<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
