<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Calculo */

$this->title = 'Cálculo de vacaciones periódicas';

$this->params['breadcrumbs'][] = ['label' => 'Calculo Vacaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculo-create">
    
    <h1><?= Html::encode($this->title) ?></h1>
   

    <?= $this->render('_form', [
        'model' => $model,'admin' => $admin
    ]) ?>
    
<style type="text/css">

body{
	background:khaki;
}

</style>

</div>

