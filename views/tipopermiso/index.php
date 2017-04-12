<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoPermisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Permisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-permiso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Ingresar Tipo de Permiso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-lg-4">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showOnEmpty'=>false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Tiper_Nombre',
                    ['label'=>'Aplica a Vacaciones','format'=>'boolean','value'=>'descuentoVacaciones'],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>


        </div>
    </div>
<style type="text/css">
body{
	background:khaki;
   
}
</style>
</div>
