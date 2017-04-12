<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Permisos */

$this->title = 'Registro de Permisos';
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permisos-create">

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
