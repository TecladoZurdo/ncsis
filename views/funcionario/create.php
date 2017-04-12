<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */

$this->title = 'Ingrese los datos del nuevo Funcionario';
$this->params['breadcrumbs'][] = ['label' => 'Registro de Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-create">

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
