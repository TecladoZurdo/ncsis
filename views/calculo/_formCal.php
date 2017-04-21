<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="calculo-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-lg-4">

            <?php echo Html::hiddenInput('fun_id', '', ['id' => 'fun_id']); ?>


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

            echo Html::label('Fecha Inicio del Período a Calcular');

            echo Html::textInput('fec_inicio', '', ['id' => 'fec_inicio', 'class' => 'form-control']);

            echo Html::label('Fecha Fin del Período a Calcular');

            echo Html::textInput('fec_fin', '', ['id' => 'fec_fin', 'class' => 'form-control']);

            
            ?>

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
            <?php
            echo Html::label('Días por Antiguedad');
            echo Html::textInput('dias_ley_cal', '', ['id' => 'dias_ley_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
            echo Html::label('Días devengados hasta la fecha');
            echo Html::textInput('dias_cal_cal', '', ['id' => 'dias_cal_cal', 'class' => 'form-control', 'readonly' => 'readonly']);

            echo Html::label('Saldo Anterior');
            echo Html::textInput('saldo_cal', '', ['id' => 'saldo_cal', 'class' => 'form-control', 'readonly' => 'readonly']);

            echo Html::label('Total Descuentos (ver detalle)');
            echo Html::textInput('num_per_cal', '', ['id' => 'num_per_cal', 'class' => 'form-control', 'readonly' => 'readonly']);


            echo Html::label('Total días calculados');

            echo Html::textInput('tot_cal', '', ['id' => 'tot_cal', 'class' => 'form-control', 'readonly' => 'readonly']);
            ?>
        </div>




        <div class="col-lg-4">  
            <CENTER> 
                <FONT  SIZE=4 COLOR=red>
                <div class="form-group">
                    <?php
                    echo Html::label('Información de uso exclusivo para Talento Humano(Días Laborales)')
                    ?>
                </div>
                </FONT>
            </CENTER>
            <?php
            echo Html::label('Días de antiguedad');
            echo Html::textInput('dias_ley_lab', '', ['id' => 'dias_ley_lab', 'class' => 'form-control', 'readonly' => 'readonly']);

            echo Html::label('Dias devengados hasta la fecha');
            echo Html::textInput('dias_cal_lab', '', ['id' => 'dias_cal_lab', 'class' => 'form-control', 'readonly' => 'readonly']);

            echo Html::label('Saldo Anterior');
            echo Html::textInput('saldo_lab', '', ['id' => 'saldo_lab', 'class' => 'form-control', 'readonly' => 'readonly']);


            echo Html::label('Total Descuentos (ver detalle)');
            echo Html::textInput('num_per_lab', '', ['id' => 'num_per_lab', 'class' => 'form-control', 'readonly' => 'readonly']);



            echo Html::label('Total Días Calculados');

            echo Html::textInput('tot_lab', '', ['id' => 'tot_lab', 'class' => 'form-control', 'readonly' => 'readonly']);


            
            ?>

        </div>

    </div>


    <div id="div_lista" class="col-lg-8" style="clear: both">
        <h2>Detalle Descuentos</h2>
        <br>
    </div>

</div>
<br>


<?php ActiveForm::end(); ?>

<?php
$url = Url::base().'@web/js/form_calculoProporcional.js';
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
