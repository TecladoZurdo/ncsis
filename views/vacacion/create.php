<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vacacion */

$this->title = 'Registro de Vacaciones';
$this->params['breadcrumbs'][] = ['label' => 'Vacaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacacion-create">

      
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
