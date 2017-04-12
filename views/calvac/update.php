<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Calvac */

//$this->title = 'Editar: ' . ' ' . $model->Cal_Id;
$this->params['breadcrumbs'][] = ['label' => 'Calculo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Cal_Id, 'url' => ['view', 'id' => $model->Cal_Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="calvac-update">

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
