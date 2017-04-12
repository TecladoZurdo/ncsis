<?php

namespace app\controllers;

use Yii;
use app\models\Calvac;
use app\models\CalvacSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Calculo;
use app\models\Funcionario;

use app\models\ViewCalvac;
use app\models\ViewCalvacSearch;
use app\models\ViewCalculoVacacionesSearch;
/**
 * CalvacController implements the CRUD actions for Calvac model.
 */
class CalvacController extends Controller
{
    public function behaviors()
    {
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
     * Lists all Calvac models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ViewCalvacSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReporte() {
        //$searchModel = new ViewCalvacSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          $searchModel = new ViewCalculoVacacionesSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          
        return $this->render('reporte', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Calvac model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findViewModel($id),
        ]);
    }

    /**
     * Creates a new Calvac model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Calvac();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Cal_Id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Calvac model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Cal_Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Calvac model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionUltimafecha($id){
        $valores="";
        $funcionario = $this->findFuncionario($id);
        $query = Calculo::find();
        $count = $query->select('count(*)')->from('calculo')->where(['Fun_Id' => $id])->scalar();
        if($count>0){
            $fechas = $this->calcularIntervalo($id);
            $fecha_fin = new \DateTime($fechas['fecha_inicio']);
            $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
            $valores['anio'] = $fecha_fin->format('Y');
        }else{
            $fecha_fin = new \DateTime($funcionario->Fun_FechaIngreso);
            $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
            $valores['anio'] = $fecha_fin->format('Y');
        }
        echo json_encode($valores);
    }
    private function calcularIntervalo($fun_id) {
        $query = Calculo::find();
        $fecha = $query->select('Cal_FechaFin')->from('calculo')->where(['Fun_Id' => $fun_id])->orderBy('Cal_FechaFin DESC')->scalar();
        $fecha_inicio = new \DateTime($fecha);
        $intervalo = new \DateInterval('P1D');
        $fecha_inicio->add($intervalo);
        $fecha_fin = new \DateTime($fecha);
        $anio = $fecha_inicio->format('Y');
        if (($anio % 4) === 0) {
            $intervalo = new \DateInterval('P366D');
        } else {
            $intervalo = new \DateInterval('P365D');
        }
        $fecha_fin->add($intervalo);
        $fechas['fecha_inicio'] = $fecha_inicio->format('Y-m-d');
        $fechas['fecha_fin'] = $fecha_fin->format('Y-m-d');
        return $fechas;
    }
    
    /**
     * Finds the Calvac model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calvac the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findFuncionario($id) {
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModel($id)
    {
        if (($model = Calvac::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function findViewModel($id) {
        $model = ViewCalvac::find()->where(['Cal_Id' => $id])->one();
        if ($model !== null) {
            return $model;
            //echo $model->Cal_Id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
