<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Liquidacion */

//$this->title = 'Update Liquidacion: ' . ' ' . $model->liq_id;
$this->params['breadcrumbs'][] = ['label' => 'Liquidacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->liq_id, 'url' => ['view', 'id' => $model->liq_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="liquidacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

   <title>Color de Fondo de la página</title>
<style type="text/css">
body{
	background:khaki;
   
}
</style>  
    
</div>
