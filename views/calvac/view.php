<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calvac */

$this->title = $model->Fun_Nombres." ".$model->Fun_Apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Estado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calvac-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Fun_Codigo',
            'Fun_Cedula',
            'Fun_Nombres',
            'Fun_Apellidos',
            'Fun_FechaIngreso',
            'Cal_FechaInicio',
            
            'Cal_FechaFin',
            'Cal_Dias',
            'Cal_Total'
        ],
    ]) ?>

    
    <style type="text/css">
    body{
        background:khaki;

    }
</style>
    
</div>
