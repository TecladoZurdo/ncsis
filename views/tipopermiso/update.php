<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoPermiso */

//$this->title = 'Update Tipo Permiso: ' . ' ' . $model->Tiper_Id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tiper_Id, 'url' => ['view', 'id' => $model->Tiper_Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-permiso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    
<style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>
