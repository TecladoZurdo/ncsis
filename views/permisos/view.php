<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Permisos */

//$this->title = $model->Per_Id;
$session = Yii::$app->session;
//echo  $session->getFlash('registro');
$this->title = $model->Fun_Nombres." ".$model->Fun_Apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permisos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Per_Id',
            'Fun_Codigo',
            'Fun_Cedula',
            'Fun_Apellidos',
            'Fun_Nombres',
            'Tiper_Nombre',
            'Fun_FechaIngreso',
            'Per_FechaInicio',
            'Per_FechaFinal',
            'Per_Dias',
            'Per_Horas',
            'Per_Minutos',
            'Per_Total',
            //'Per_Valor',
            //'Fun_Id',
            //'Tiper_Id',
        ],
    ]) ?>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
