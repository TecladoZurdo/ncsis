<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FuncionarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingreso de Funcionarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionario-index">
    
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Ingresar Nuevo Funcionario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Fun_Id',
            'Fun_Codigo',
            'Fun_Cedula',
             'Fun_Apellidos',
            'Fun_Nombres',
            'Fun_FechaIngreso',
            'Fun_Estado',
            // 'Fun_VacAcumuladas',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/funcionario/view','id'=>$model->Fun_Id], [
                                    'title' => Yii::t('app', 'View'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/funcionario/update','id'=>$model->Fun_Id], [
                                    'title' => Yii::t('app', 'Update'),
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
<!--el div  esta mal cerrado-->
