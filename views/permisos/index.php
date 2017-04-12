<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PermisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingreso de Permisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permisos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Permisos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
             'Fun_Apellidos',
            'Fun_Nombres',
            'Per_FechaInicio',
            'Per_FechaFinal',
            'Tiper_Nombre',
            'Per_Dias',
            'Per_Horas',
            'Per_Minutos',
            'Per_ValorCal',
            'Per_ValorLab', 
            'Per_Total',
            
            // 'Per_Minutos',
            // 'Per_Total',
            // 'Per_Valor',
            // 'Fun_Id',
            //'Tiper_Id',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/permisos/view', 'id' => $model->Per_Id], [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                            'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/permisos/update', 'id' => $model->Per_Id], [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                            'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/permisos/delete', 'id' => $model->Per_Id], [
                                    'title' => Yii::t('app', 'View'),
                                    'data-pajax' => '0',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Está seguro que borrar éste registro?'
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
