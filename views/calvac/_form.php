<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="calvac-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?php echo Html::activeHiddenInput($model, 'Fun_Id'); ?>
            <CENTER> 
                <FONT  SIZE=4 COLOR=red>
                <div class="form-group">
                    <?php
                    echo Html::label('Datos del Funcionario');
                    ?>
                </div>
                </FONT>
            </CENTER>
            <?php
            echo Html::label('Busqueda Funcionario');

            echo Html::textInput('funcionario', '', ['id' => 'funcionario', 'class' => 'form-control']);

            echo Html::label('Nombre del Funcionario');

            echo Html::textInput('Fun_Nombre', '', ['id' => 'Fun_Nombre', 'class' => 'form-control', 'readonly' => 'readonly']);

            echo Html::label('Fecha de Ingreso');

            echo Html::textInput('fecha_ing', '', ['id' => 'fecha_ing', 'class' => 'form-control', 'readonly' => 'readonly']);


            echo Html::label('Código de Funcionario');

            echo Html::textInput('codigo', '', ['id' => 'codigo', 'class' => 'form-control', 'readonly' => 'readonly']);
            ?>

            <?= $form->field($model, 'Cal_FechaInicio')->textInput(['readonly' => 'readonly']) ?>

            <?= $form->field($model, 'Cal_FechaFin')->textInput() ?>
            <?= $form->field($model, 'Cal_Anio')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
        </div>
        <div class="col-lg-4">
            <CENTER> 
                <FONT  SIZE=4 COLOR=red>
                <div class="form-group">
                    <?php
                    echo Html::label('Información de uso exclusivo para el Funcionario (Días Calendario)');
                    ?>
                </div>
                </FONT>
            </CENTER>
            
            <?= $form->field($model, 'Cal_Ley')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            
            <?= $form->field($model, 'Cal_Dias')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            
            <?= $form->field($model, 'Cal_Saldo')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            
            <?= $form->field($model, 'Cal_Permisos')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
            
            <?= $form->field($model, 'Cal_Total')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

        </div>

    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <div id="div_lista" class="col-lg-8" style="clear: both">
        <h2>Detalle de Permisos</h2>
        <br>


    </div>
    <a href="<?php echo Url::base().'../calculo/buscarfuncionario';  ?>" id="link_funcionario" />
    <a href="<?php echo Url::base().'../calvac/ultimafecha?id=';  ?>" id="link_fecha" />

    <?php ActiveForm::end(); ?>


    <?php
    $url = Url::base() . '@web/js/form_calvac.js';
    $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
    ?>

    <style type="text/css">
    body{
        background:khaki;

    }
</style>
    
</div>
    