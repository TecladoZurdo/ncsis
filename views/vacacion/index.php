<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro de Vacaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Vacaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'Fun_Codigo',
            'Fun_Apellidos',
            'Fun_Nombres',
            'Vac_FechaInicio',
            'Vac_FechaFinal',
            'Vac_Dias',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/vacacion/view', 'id' => $model->Vac_Id], [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                            'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/vacacion/update', 'id' => $model->Vac_Id], [
                                    'title' => Yii::t('app', 'Update'),
                        ]);
                    },
                            'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/vacacion/delete', 'id' => $model->Vac_Id], [
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
