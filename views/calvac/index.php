<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CalvacSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado Vacaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calvac-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Estado Actual de Vacaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Fun_Apellidos',
            'Fun_Nombres',
            'Cal_FechaInicio',
            'Cal_FechaFin',
            'Cal_Dias',
            'Cal_Ley',
            'Cal_Saldo',
           'Cal_Permisos',
             'Cal_Total',
            // 'Cal_Total',
            // 'Fun_Id',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/calvac/view','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/calvac/update','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/calvac/delete','id'=>$model->Cal_Id], [
                                    'title' => Yii::t('app', 'View'),
                                    'data-pajax'=>'0',
                                    'data-method'=>'post',
                                    'data-confirm'=>'Está seguro que borrar éste registro?'
                        ]);
                    },
                            
                        ],
                    ],
        ],
    ]); ?>

    
    <style type="text/css">
    body{
        background:khaki;

    }
</style>
</div>
