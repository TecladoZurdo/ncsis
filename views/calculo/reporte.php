<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Reporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resumen-index">
    <?php
// Generate a bootstrap responsive striped table with row highlighted on hover
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => [
            'fontAwesome' => true,
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK
        ],
        'columns' => [
            ['class' => '\kartik\grid\SerialColumn'],
             'Fun_Apellidos',
            'Fun_Nombres',
            'Cal_FechaInicio',
            'Cal_FechaFin',
            'Cal_DiasCal',
            'Cal_DiasLab',
            'Cal_SalLab',
            'Cal_SalCal',
            'TotPerCal',
            'TotPerLab',
            //'Dias_Res_Cal',
            //'Dias_Res_Lab'
        ],
        'pjax' => true,
        'showPageSummary' => true,
        'panel' => [
            'type' => 'primary',
            'heading' => 'Reporte de Calculos'
        ]
    ]);
    ?>
    
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>