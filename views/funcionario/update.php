<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */


$this->params['breadcrumbs'][] = ['label' => 'Ingreso Funcionario', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '', $model->Fun_Id, 'url' => ['view', 'id' => $model->Fun_Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="funcionario-update">

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
