<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */

$this->title = $model->Fun_Nombres." ".$model->Fun_Apellidos;
$this->params['breadcrumbs'][] = ['label' => 'Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Fun_Id',
            'Fun_Codigo',
            'Fun_Cedula',
             'Fun_Apellidos',
            'Fun_Nombres',
            'Fun_FechaIngreso',
            'Fun_Estado',
            'Fun_VacAcumuladas',
        ],
    ]) ?>
 
    
<style type="text/css">
body{
	background:khaki;
   
}
</style>

</div>
