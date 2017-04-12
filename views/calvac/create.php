<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Calvac */

$this->title = 'Estado de vacaciones';
$this->params['breadcrumbs'][] = ['label' => 'Estado vacaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calvac-create">

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
