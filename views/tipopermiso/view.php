<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoPermiso */


$this->title = 'Permiso Registrado'; $model->Tiper_Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-permiso-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tiper_Id',
            'Tiper_Nombre'
        ],
    ]) ?>

     <style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>
