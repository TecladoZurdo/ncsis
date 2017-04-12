<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Permisos */

//$this->title = 'Update Permisos: ' . ' ' . $model->Per_Id;
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Per_Id, 'url' => ['view', 'id' => $model->Per_Id]];
$this->params['breadcrumbs'][] = 'Editar';

//print_r($funcionario."hrllo");
?>
<div class="permisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'funcionario'=>$funcionario,
    ]) ?>
 
    
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
