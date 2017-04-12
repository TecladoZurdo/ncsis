<?php

namespace app\controllers;

use Yii;
use app\models\Permisos;
use app\models\PermisosSearch;
use app\models\ViewPermisoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Funcionario;
use app\models\FuncionarioSearch;

/**
 * PermisosController implements the CRUD actions for Permisos model.
 */
class PermisosController extends Controller {

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
     * Lists all Permisos models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ViewPermisoSearch();
        //$searchModel=$searchModel->where(['Fun_Id' => '21']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReporte() {
        $searchModel = new ViewPermisoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('reporte', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permisos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findViewModel($id),
        ]);
    }

    /**
     * Creates a new Permisos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Permisos();
        $post = Yii::$app->request->post();
        unset($post['funcionario']);
        

        if ($model->load(Yii::$app->request->post())) {
            //$model->Per_ValorCal=$model->Per_ValorLab;
            $model->Per_ValorCal=$model->Per_Total;
            if ($model->save()) {
                $session = Yii::$app->session;
                $registro = $this->calcularPermisos($model->Fun_Id, $model->Per_FechaFinal);
                $session->setFlash('registro', $registro);
                return $this->redirect(['view', 'id' => $model->Per_Id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Permisos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
     
        $funcionario = $this->findFuncionario($model->Fun_Id);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->Per_ValorCal=$model->Per_Total;
            if ($model->save()){
                
                return $this->redirect(['view', 'id' => $model->Per_Id]);
            }
            
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'funcionario' => $funcionario,
            ]);
        }
    }

    /**
     * Deletes an existing Permisos model.
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

    /**
     * Finds the Permisos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Permisos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Permisos::findOne($id)) !== null) {

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
        $model = \app\models\ViewPermiso::find()->where(['Per_Id' => $id])->one();
        if ($model !== null) {
            return $model;
            //echo $model->Cal_Id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function calcularPermisos($fun_id, $fec_base) {
        $mensaje = '';
        $model = Funcionario::findOne($fun_id);
        $fec_arr = explode("-", $model->Fun_FechaIngreso);
        $dia_ini = $fec_arr[2];
        $mes_ini = $fec_arr[1];
        $fecha2 = explode("-", $fec_base);
        $anio_ini = $fecha2[0] - 1;
        $fecha = $anio_ini . '-' . $mes_ini . '-' . $dia_ini;
        $fecha_ini = new \DateTime($fecha);
        $fecha_fin = new \DateTime($fecha);
        if (($anio_ini % 4) === 0)
            $intervalo = new \DateInterval('P366D');
        else
            $intervalo = new \DateInterval('P365D');
        $fecha_fin->add($intervalo);
        $fec_ini = $fecha_ini->format('Y-m-d');
        $fec_fin = $fecha_fin->format('Y-m-d');
        $query = Permisos::find();
        /*$registro = $query->select('sum(Per_ValorLab)')->from('Permisos')
                ->andFilterWhere(['between', 'Per_FechaInicio', $fec_ini, $fec_fin])
                ->andFilterWhere(['between', 'Per_FechaFinal', $fec_ini, $fec_fin])
                ->andFilterWhere(['Fun_Id' => $fun_id])
                ->scalar();
        $mensaje='permisos='.$registro;*/
        //if($registro==null){
            $registro = $query->select('sum(Per_ValorLab)')->from('permisos')
                ->where(['between', 'Per_FechaInicio', $fec_ini, $fec_fin])
                ->where(['between', 'Per_FechaFinal', $fec_ini, $fec_fin])
                ->where(['Fun_Id' => $fun_id])
                ->scalar();
            $mensaje='permisos='.$registro.' fun_id='.$fun_id;
        //}
        
        $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
        $mensaje.='fines de semana='.$permisos;
        if ($registro >= 7 && $registro <= 14) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            $mensaje.='entro al primer caso';
            if ($permisos == null) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        } 
        elseif ($registro >= 15 && $registro <= 22) {
            //$permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 2 && $permisos < 4) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 23 && $registro <= 29) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 4 && $permisos < 6) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 30 && $registro <= 37) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 6 && $permisos < 8) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 38 && $registro <=44) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 8 && $permisos < 10) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 45 && $registro <= 52) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 12 && $permisos < 14) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 53 && $registro <=59) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 14 && $permisos < 16) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        elseif ($registro >= 60) {
            $permisos = $this->dias_permiso($fec_ini, $fec_fin, $fun_id);
            if ($permisos >= 16) {
                $this->insert_permiso($fec_base, $fun_id);
            }
        }
        return $mensaje;
    }

    //dias de permiso obligatorio
    public function dias_permiso($fec_ini, $fec_fin, $fun_id) {
        $query = Permisos::find();
        $permisos = $query->select('sum(Per_ValorCal)')->from('permisos')
                ->andFilterWhere(['between', 'Per_FechaInicio', $fec_ini, $fec_fin])
                ->andFilterWhere(['between', 'Per_FechaFinal', $fec_ini, $fec_fin])
                //->andFilterWhere(['Fun_Id' => $fun_id,'Tiper_Id'=>7])
                ->andFilterWhere(['like','Fun_Id',$fun_id])
                ->andFilterWhere(['like','Tiper_Id',7])
                ->scalar();
        if($permisos==null){
            $permisos = $query->select('sum(Per_ValorCal)')->from('permisos')
                ->where(['between', 'Per_FechaInicio', $fec_ini, $fec_fin])
                ->where(['between', 'Per_FechaFinal', $fec_ini, $fec_fin])
                //->andFilterWhere(['Fun_Id' => $fun_id,'Tiper_Id'=>7])
                ->where(['like','Fun_Id',$fun_id])
                ->where(['like','Tiper_Id',7])
                ->scalar();
        }
            //$permisos=0;
        return $permisos;
    }
    

    public function insert_permiso($fec_base,$fun_id) {
        $mensaje="";
        $fe_ini = new \DateTime($fec_base);
        $fe_fin = new \DateTime($fec_base);
        $dias = new \DateInterval('P2D');
        $fe_fin->add($dias);
        $permiso = new Permisos();
        $permiso->Per_FechaInicio = $fe_ini->format('Y-m-d');
        $permiso->Per_FechaFinal = $fe_fin->format('Y-m-d');
        $permiso->Per_Dias = 2;
        $permiso->Per_Horas = 0;
        $permiso->Per_Minutos = 0;
        $permiso->Per_Total = 0;
        $permiso->Per_ValorCal = 2;
        $permiso->Per_ValorLab = 0;
        $permiso->Fun_Id = $fun_id;
        $permiso->Tiper_Id = 7;
        if ($permiso->save()) {
            $mensaje = "Permiso Modificado";
        }
        return $mensaje;
    }

}
