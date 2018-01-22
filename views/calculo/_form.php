<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Calculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calculo-form">

    <?php $form = ActiveForm::begin([
        'id'=>'vacaciones_periodicas'
    ]); ?>
    <div class="row">

        <div class="col-lg-4">

            <?php echo Html::activeHiddenInput($model, 'Fun_Id'); ?>
            <?php echo Html::hiddenInput('estado', '', ['id' => 'estado']); ?>

            <CENTER> 
                <FONT  SIZE=4 COLOR=red>
                <div class="form-group">
                    <?php
                    echo Html::label('Datos del Funcionario');
                    ?>
                </div>
                </FONT>
            </CENTER>

            <div class="form-group">


                <?php
                echo Html::label('Busqueda de Funcionario');
                if ($model->isNewRecord)
                    echo Html::textInput('funcionario', '', ['id' => 'funcionario', 'class' => 'form-control']);
                else
                    echo Html::textInput('funcionario', $funcionario->Fun_Cedula, ['id' => 'funcionario', 'class' => 'form-control']);
                ?>
            </div>
            <div class="form-group">


                <?php
                echo Html::label('Nombre del Funcionario');
                if ($model->isNewRecord)
                    echo Html::textInput('Fun_Nombre', '', ['id' => 'Fun_Nombre', 'class' => 'form-control', 'readonly' => 'readonly']);
                else
                    echo Html::textInput('Fun_Nombre', $funcionario->Fun_Nombres . " " . $funcionario->Fun_Apellidos, ['id' => 'Fun_Nombre', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">
                <?php
                echo Html::label('Fecha de Ingreso');

                echo Html::textInput('fecha_ing', '', ['id' => 'fecha_ing', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">
                <?php
                echo Html::label('Codigo de Funcionario');

                echo Html::textInput('codigo', '', ['id' => 'codigo', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'Cal_FechaInicio')->textInput(['readonly' => 'readonly']) ?>
                <?= $form->field($model, 'Cal_FechaFin')->textInput(['readonly' => 'readonly']) ?>
                <?= $form->field($model, 'Cal_Anio')->textInput(['readonly' => 'readonly']) ?>
            </div>
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

            <div class="form-group">
                <?php
                echo Html::label('Días Por Ley');

                echo Html::textInput('vac_dias_cal', '', ['id' => 'vac_dias_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">
                <?php
                echo Html::label('Días por Antiguedad');

                echo Html::textInput('dias_ley_cal', '', ['id' => 'dias_ley_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">
                <?php
                echo Html::label('Saldo Anterior');

                echo Html::textInput('vac_acu_cal', '', ['id' => 'vac_acu_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo Html::label('Total Descuentos (ver detalle)');
                echo Html::textInput('num_per_cal', '', ['id' => 'num_per_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>


            
            <?= $form->field($model, 'Cal_DiasCal')->textInput(['readonly' => 'readonly']) ?>
            
            <div class="form-group">
                <?php
                //echo Html::label('Total Vacaciones');
                //echo Html::textInput('tot_vac_cal', '', ['id' => 'tot_vac_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
                <?= $form->field($model, 'Cal_SalCal')->textInput(['readonly' => 'readonly']) ?>
            </div>

        </div>



        <div class="col-lg-4">
            <?php if ($admin) { ?>
            <CENTER>
                <FONT  SIZE=4 COLOR=red>
                <div class="form-group">           
                    <?php
                    echo Html::label('Información de uso exclusivo para Talento Humano (Días Laborales)');
                    ?>
                </div>
                </FONT>
            </CENTER>


            <div class="form-group">
                <?php
                echo Html::label('Días Por Ley ');
                echo Html::textInput('vac_dias_lab', '', ['id' => 'vac_dias_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>

            </div>
            <div class="form-group">
                <?php
                echo Html::label('Días de Antiguedad');

                echo Html::textInput('dias_ley_lab', '', ['id' => 'dias_ley_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>

            <div class="form-group">

                <?php
                echo Html::label('Saldo Anterior');


                echo Html::textInput('vac_acu_lab', '', ['id' => 'vac_acu_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>


            <div class="form-group">

                <?php
                echo Html::label('Total Descuentos (ver detalle)');
                echo Html::textInput('num_per_lab', '', ['id' => 'num_per_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
            </div>



          
            <?= $form->field($model, 'Cal_DiasLab')->textInput(['readonly' => 'readonly']) ?>

            <div class="form-group">

                <?php
                //echo Html::label(' Total Días Generados + Saldo Anterior (Laborales: ojo aqui debe ir el total luego de restar permisos e inckur saldo anterior');

                //echo Html::textInput('tot_vac_lab', '', ['id' => 'tot_vac_lab', 'class' => 'form-control', 'readonly' => 'readonly']);
                ?>
                <?= $form->field($model, 'Cal_SalLab')->textInput(['readonly' => 'readonly']) ?>
            </div>

            <?php } ?>
        </div>








    </div>
    <br>
    <div id="div_guardar" class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <div id="div_regresar" style="display:none;" class="form-group">
        <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>


    <br>

    <div id="div_lista" class="col-lg-4" style="clear: both" >
        <h2>Detalle Descuentos</h2>
        <br>


    </div>

    <?php
    $url = Url::base() . '@web/js/form_calculo.js';
    $this->registerJsFile($url, ['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
    ?>

 <div  id="div_lista" class="col-lg-4" style="clear: both">
        <h4>Elaborado Por:</h4>
        
        <br>


    </div>
    
    <div class="col-lg-4">
        <h4>Autorizado Por:</h4>
<br>
    </div>
    
<div class="col-lg-4">
        <h4>Aceptado Funcionario:</h4>
        
    </div>
    <style type="text/css">
        body{
            background:khaki;

        }
    </style>



</div>
