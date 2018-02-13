<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Calculo */

$this->title = $model->Fun_Nombres." ".$model->Fun_Apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Calculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculo-view">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Cal_Id',
            'Fun_Codigo',
            'Fun_Cedula',
            'Fun_Nombres',
            'Fun_Apellidos',
            'Fun_FechaIngreso',
            'Cal_FechaInicio',
            'Cal_FechaFin',
            'Cal_DiasCal',
            'Cal_DiasLab',
            'Cal_SalCal',
            'Cal_SalLab',
            'Cal_Anio',
            [
                'label' => 'Saldo Anterior',
                'value' => $saldoAnterior
            ],
            [
                'label' => 'Días por ley',
                'value' => $diasXley
            ],
            [
                'label' => 'Días por Antiguedad',
                'value' => $diasXantiguedad
            ],
            [
                'label' => 'Total Descuentos',
                'value' => $totalDescuentos
            ]
            //'Fun_Id',
        ],
    ]) ?>



<div class="container">
    <div class="alert-info">
        <h3><span class="label label-primary">Detalle Descuentos</span></h3>
    
    <div class="row">
        <div id="div_lista" class="col-lg-6" style="clear: both" >
        <?php
    echo "<div class='col-lg-6' style='clear:both'><b>Permiso</b></div>";
    echo "<div class='col-lg-2'><b>Días</b></div>";    
   foreach ($row_set as $item) {
    echo "<div class='col-lg-6' style='clear:both'>".$item['permiso']."</div>";
    echo "<div class='col-lg-2'>".$item['dias']."</div>";
}  

 ?>    
        </div>
    </div>
    </div>
</div>

    <?php
    // $script = Url::base() . '@web/js/guardarCalculo.js';
    // $this->registerJsFile($script,['depends' => [\yii\web\JqueryAsset::className(), \yii\jui\JuiAsset::className()]]);
    ?>
  
<style type="text/css">
body{
	
	background:khaki;

}
</style>
</div>
