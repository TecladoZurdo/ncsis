<?php

namespace app\controllers;

use Yii;
use app\models\Vacacion;
use app\models\VacacionSearch;
use app\models\ViewVacacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Funcionario;
use app\models\FuncionarioSearch;
use app\models\Calculo;
use app\models\ViewTotalSearch;

/**
 * VacacionController implements the CRUD actions for Vacacion model.
 */
class VacacionController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vacacion models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ViewVacacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReporte() {
        $searchModel = new ViewVacacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reporte', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionResumen() {
        $searchModel = new ViewTotalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('resumen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findViewModel($id),
        ]);
    }

    /**
     * Creates a new Vacacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Vacacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Vac_Id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vacacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $funcionario = $this->findFuncionario($model->Fun_Id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Vac_Id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'funcionario' => $funcionario,
            ]);
        }
    }

    /**
     * Deletes an existing Vacacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBuscarfuncionario($term) {
        $data = new FuncionarioSearch;
        $data->autocomplete($term);
    }

    public function actionVacaciones($id) {
        $query1=  Calculo::find();
        $cal_lab=$query1->select('sum(Cal_DiasLab)')->from('calculo')->where(['Fun_Id'=>$id])->scalar();
        $query2= Vacacion::find();
        $vac_lab=$query2->select('sum(Vac_DiasLab)')->from('vacacion')->where(['Fun_Id'=>$id])->scalar();
        $cal_cal=$query1->select('sum(Cal_DiasCal)')->from('calculo')->where(['Fun_Id'=>$id])->scalar();
        $vac_cal=$query2->select('sum(Vac_DiasCal)')->from('vacacion')->where(['Fun_Id'=>$id])->scalar();
        $valores['tot_lab']=$cal_lab-$vac_lab;
        $valores['tot_cal']=$cal_cal-$vac_cal;
        echo json_encode($valores);
    }
    
    

    /**
     * Finds the Vacacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vacacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findFuncionario($id) {
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function findViewModel($id) {
        $model = \app\models\ViewVacacion::find()->where(['Vac_Id' => $id])->one();
        if ($model !== null) {
            return $model;
            //echo $model->Cal_Id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
