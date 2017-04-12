<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacacion */

$this->title = $this->title = 'Vacación Registrada';$model->Vac_Id;
$this->params['breadcrumbs'][] = ['label' => 'Vacacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Vac_Id',
            'Fun_Codigo',
            'Fun_Cedula',
            'Fun_Nombres',
            'Fun_Apellidos',
            'Fun_FechaIngreso',
            'Vac_FechaInicio',
            'Vac_FechaFinal',
            'Vac_Dias',
            'dias_res',
            'dias_cal',
            'permisos'
            
        ],
    ]) ?>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
