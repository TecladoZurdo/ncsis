    <?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalculoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacaciones Periódicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Calcular', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'Cal_Id',
            'Fun_Apellidos',
            'Fun_Nombres',
            'Cal_FechaInicio',
            'Cal_FechaFin',
            'Cal_DiasCal',
            'Cal_DiasLab',
            'Cal_SalLab',
            'Cal_SalCal',
            //'TotPerCal',
            //'TotPerLab',
            //'Dias_Res_Cal',
            //'Dias_Res_Lab',
            //'Cal_Anio',
            // 'Fun_Id',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/calculo/view','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/calculo/update','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/calculo/delete','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'View'),
                                    'data-pajax'=>'0',
                                    'data-method'=>'post',
                                    'data-confirm'=>'Está seguro que borrar éste registro?'
                        ]);
                    },
                            
                        ],
                    ],
                ],
            ]);
            ?>
<style type="text/css">
body{
	
	background:khaki;

}
</style>
</div>
