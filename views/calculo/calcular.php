<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Calculo */

$this->title = 'Cálculo Proporcional';
$this->params['breadcrumbs'][] = ['label' => 'Calculos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCal') ?>
    
  <style type="text/css">
body{
	background:khaki;
   
}
</style>
    
</div>

