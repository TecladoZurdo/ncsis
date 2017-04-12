<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Liquidacion */

$this->title = $model->liq_id;
$this->params['breadcrumbs'][] = ['label' => 'Liquidacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->liq_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->liq_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'liq_id',
            'Liq_FechaInicio',
            'Liq_FechaFinal',
            'Liq_Dias',
            'Vac_Id',
        ],
    ]) ?>
    
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
