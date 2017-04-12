<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LiquidacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liquidacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Liquidacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'liq_id',
            'Liq_FechaInicio',
            'Liq_FechaFinal',
            'Liq_Dias',
            'Vac_Id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
