<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calculo */

//$this->title = $model->Cal_Id;
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
            //'Fun_Id',
        ],
    ]) ?>
<style type="text/css">
body{
	
	background:khaki;

        
}
</style>
</div>
