<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Reporte Vacaciones';
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
                //'Fun_Id',
                'apellidos',
                'nombres',
                'CalDiasCal',
                'VacCal',
                'TotCal',
                'Per_ValorCal',
                
            // 'Fun_Estado',
// 'Fun_VacAcumuladas',
            ],
            'pjax' => true,
            'showPageSummary' => true,
            'panel' => [
                'type' => 'primary',
                'heading'=>'Reporte Resumen de Vacaciones'
            ]
        ]);
        ?>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>