

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $searchModel app\models\ViewCalculoVacacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resumen-index table-responsive">
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
            'fechaactual',
            'iniperiodo',
            'finperiodo',
            'antiguedad',
            'diasdevengados',
            'saldoanterior',
            'descuentos',
            #'descuentoslaborables',
            
            #'saldoanteriorLab',
            'total'
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