<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacacion */

//$this->title = 'Update Vacacion: ' . ' ' . $model->Vac_Id;
$this->params['breadcrumbs'][] = ['label' => 'Vacaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Vac_Id, 'url' => ['view', 'id' => $model->Vac_Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="vacacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'funcionario' => $funcionario,
    ]) ?>

     <title>Color de Fondo de la página</title>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>
