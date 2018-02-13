<?php

namespace app\controllers;

use Yii;
use app\models\Calculo;
use app\models\CalculoSearch;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Funcionario;
use app\models\FuncionarioSearch;
use app\models\Permisos;
use app\models\Vacacion;
use app\models\ViewCalculo;
use app\models\ViewCalculoSearch;
use app\models\ViewTotal;
use app\models\ViewPermiso;


/**
 * CalculoController implements the CRUD actions for Calculo model.
 */
class CalculoController extends Controller {

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
     * Lists all Calculo models.
     * @return mixed
     */
    public function actionIndex() {
        /* $searchModel = new CalculoSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          ]);
         * */
        $searchModel = new ViewCalculoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReporte() {
        $searchModel = new ViewCalculoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reporte', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Calculo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$funId,$saldoAnterior,$diasXley,$diasXantiguedad, $totalDescuentos) {

        $model = $this->findViewModel($id);
        $row_set = $this->queryViewPermiso($funId,$model->Cal_FechaInicio, $model->Cal_FechaFin);
        

        return $this->render('view', [
                    'model' => $model,'funId'=>$funId,'row_set'=>$row_set,'saldoAnterior'=>$saldoAnterior,
                    'diasXley' => $diasXley, 'diasXantiguedad'=>$diasXantiguedad, 'totalDescuentos'=>$totalDescuentos
        ]);
    }

    /**
     * Creates a new Calculo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $CalculoActual = new Calculo();
        
        $identity = Yii::$app->user->identity;
        $admin = false;
        if ($identity != null) {
            if ($identity->username == 'TALENTOHUMANO'){
                $admin = true;
            }
        }
        
        if ($CalculoActual->load(Yii::$app->request->post())) {
                 $funId = $CalculoActual->Fun_Id;
                 $saldoAnterior = Yii::$app->request->post("vac_acu_cal");
                 $diasXley = Yii::$app->request->post("vac_dias_cal");
                 $diasXantiguedad = Yii::$app->request->post("dias_ley_cal");
                 $totalDescuentos = Yii::$app->request->post("num_per_cal");
                 
                 $CalculoActual->save();
            return $this->redirect(['view', 'id' => $CalculoActual->Cal_Id,
                'funId'=>$funId,'saldoAnterior'=>$saldoAnterior, 'diasXley'=>$diasXley,
                'diasXantiguedad'=>$diasXantiguedad, 'totalDescuentos'=>$totalDescuentos]);
        } else {
            return $this->render('create', [ 'model' => $CalculoActual, 'admin' => $admin]);
        }
    }

    /**
     * Updates an existing Calculo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $funcionario = $this->findFuncionario($model->Fun_Id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Cal_Id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'funcionario' => $funcionario,
            ]);
        }
    }

    public function actionCalcular() {
        $identity = Yii::$app->user->identity;
        $admin = false;
        if ($identity != null) {
            if ($identity->username == 'TALENTOHUMANO'){
                $admin = true;
            }
        }
        return $this->render('calcular', ['admin' => $admin]);
    }

    public function actionVacaciones() {
        return $this->render('vac_cal');
    }

    /**
     * Deletes an existing Calculo model.
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
     * Metodo  que suma los permisos y retorna un JSON
     * total permisos calendario - tot_cal  // se considera calendario
     * total permisos laborales  - tot_lab  // laborales cuando esta entre lunes a viernes
     */
    public function actionPermisos() {
        $query = Permisos::find();
        $id = Yii::$app->request->post("id");
        $fecha_inicio = Yii::$app->request->post("fecha_inicio");
        $fecha_fin = Yii::$app->request->post("fecha_fin");
        $val_cal = $query->select('sum(Per_ValorCal)')->from('permisos')
                ->join('inner join','tipopermiso','tipopermiso.Tiper_Id=permisos.Tiper_Id and tipopermiso.descuentoVacaciones=1')
                ->where(['between', 'Per_FechaInicio', $fecha_inicio, $fecha_fin])
                ->where(['between', 'Per_FechaFinal', $fecha_inicio, $fecha_fin])
                ->andFilterWhere(['Fun_Id' => $id])
                ->scalar();
        $val_lab=$val_cal;
        if ($val_lab>7 and $val_lab<=14){
            $val_lab=$val_lab-2;
    }else{
        if ($val_lab>14 and $val_lab<=22){
            $val_lab=$val_lab-4;
        }else{
            if ($val_lab>22 and $val_cal<=29){
                $val_lab=$val_lab -6;
            }else{
                if($val_lab>29 and $val_lab<=37){
                    $val_lab=$val_lab-8;
                }else {
                    if ($val_lab>37 and $val_lab<=44){
                        $val_lab=$val_lab-10;
                    }else {
                        if($val_lab>44 and $val_lab<=52){
                            $val_lab=$val_lab-12;
                        }
                        else {
                            if($val_lab>52 and $val_lab<=59){
                               $val_lab=$val_lab-14;
                            }else {
                                if ($val_lab>60){
                                    $val_lab=$val_lab-16;
                                }
                            }
                        }
                    }
                }
            }
        }

    }


        $valores['tot_cal'] = $val_cal !== null ? $val_cal : 0;

        $valores['tot_lab'] = $val_lab !== null ? $val_lab : 0;
        echo json_encode($valores);
    }

    /**
     * Metodo  que suma los permisos y retorna un JSON
     * total permisos calendario - tot_cal  // se considera calendario
     * total permisos laborales  - tot_lab  // laborales cuando esta entre lunes a viernes
     */
    public function getPermisos($funId,$fechaInicio,$fechaFin) {
        $query = Permisos::find();
        $val_cal = $query->select('sum(Per_ValorCal)')->from('permisos')
                ->join('inner join','tipopermiso','tipopermiso.Tiper_Id=permisos.Tiper_Id and tipopermiso.descuentoVacaciones=1')
                ->where(['between', 'Per_FechaInicio', $fechaInicio, $fechaFin])
                ->where(['between', 'Per_FechaFinal', $fechaInicio, $fechaFin])
                ->andFilterWhere(['Fun_Id' => $funId])
                ->scalar();
        $val_lab=$val_cal;
        if ($val_lab>7 and $val_lab<=14){
            $val_lab=$val_lab-2;
    }else{
        if ($val_lab>14 and $val_lab<=22){
            $val_lab=$val_lab-4;
        }else{
            if ($val_lab>22 and $val_cal<=29){
                $val_lab=$val_lab -6;
            }else{
                if($val_lab>29 and $val_lab<=37){
                    $val_lab=$val_lab-8;
                }else {
                    if ($val_lab>37 and $val_lab<=44){
                        $val_lab=$val_lab-10;
                    }else {
                        if($val_lab>44 and $val_lab<=52){
                            $val_lab=$val_lab-12;
                        }
                        else {
                            if($val_lab>52 and $val_lab<=59){
                               $val_lab=$val_lab-14;
                            }else {
                                if ($val_lab>60){
                                    $val_lab=$val_lab-16;
                                }
                            }
                        }
                    }
                }
            }
        }

    }

        $valores['tot_cal'] = $val_cal !== null ? $val_cal : 0;
        $valores['tot_lab'] = $val_lab !== null ? $val_lab : 0;
        return $valores;
    }

    public function queryViewPermiso($id, $fecha_inicio, $fecha_fin) {
        $query = ViewPermiso::find();
        $registro = $query->select(['Tiper_Nombre'])->from('view_permiso')
                ->where(['between', 'Per_FechaInicio', $fecha_inicio, $fecha_fin])
                ->where(['between', 'Per_FechaFinal', $fecha_inicio, $fecha_fin])
                ->andFilterWhere(['Fun_Id' => $id])
                ->groupBy(['Tiper_Nombre'])
                ->all();
        if (count($registro) > 0) {
            foreach ($registro as $item) {
                $nombre = $item['Tiper_Nombre'];
                $new_row['permiso'] = $nombre;
                $new_row['dias'] = $this->sumaPermisos($nombre, $fecha_inicio, $fecha_fin, $id);
                $row_set[] = $new_row;
            }
        } else {
            $new_row['permiso'] = '';
            $new_row['dias'] = '';
            $row_set[] = $new_row;
        }

        return $row_set;
    }

    public function actionListapermisos() {

        $id = Yii::$app->request->post("id");
        $fecha_inicio = Yii::$app->request->post("fecha_inicio");
        $fecha_fin = Yii::$app->request->post("fecha_fin");
        
        $row_set = $this->queryViewPermiso($id,$fecha_inicio,$fecha_fin);
        
        echo json_encode($row_set);
    }

    

    public function sumaPermisos($nombre, $fecha_inicio, $fecha_fin, $id) {
        $query = ViewPermiso::find();
        $registro = $query->select(['sum(Per_ValorCal)'])->from('view_permiso')
                        ->where(['between', 'Per_FechaInicio', $fecha_inicio, $fecha_fin])
                        ->where(['between', 'Per_FechaFinal', $fecha_inicio, $fecha_fin])
                        ->andFilterWhere(['Fun_Id' => $id])
                        ->andFilterWhere(['Tiper_Nombre' => $nombre])->scalar();

        return $registro;
    }

    //ultima fecha de calculo
    //
    public function actionUltimafecha($id) {
        $valores = "";
        $funcionario = $this->findFuncionario($id);
        $query = Calculo::find();
        $count = $query->select('count(*)')->from('calculo')->where(['Fun_Id' => $id])->scalar();
        if ($count > 0) {
            $fechas = $this->calcularIntervalo($id);
            $fecha_fin = new \DateTime($fechas['fecha_inicio']);
            $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
        } else {
            $fecha_fin = new \DateTime($funcionario->Fun_FechaIngreso);
            $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
        }
        echo json_encode($valores);
    }

/**
 * Funcion que procesa los calculos para las vacaciones
 *   periodicas
 **/

 public function actionVacaciones_periodicas($id){
    $funcionario = $this->findFuncionario($id);
    $query = Calculo::find();
    $fecha_base = new \DateTime('2015-01-01');
    $fecha_actual = new \DateTime(date('Y-m-d'));
    $fecha_ingreso = new \DateTime($funcionario->Fun_FechaIngreso);
    $saldoAcumuladoL =0;
    $saldoAcumuladoC =0;
    // da el ultimo calculo realizado
    $calculoAnterior = $query->select('Cal_FechaFin')->from('calculo')->where(['Fun_Id' => $id,'activo'=>true])->orderBy('Cal_FechaFin DESC')->scalar();
    if ($calculoAnterior != null ){ //si ya tiene un calculo anterior

        //-- sumara saldos anteriores y calcular nuevo periodo
        $fechas = $this->calcularIntervalo($fecha_ingreso,$calculoAnterior);
            $fecha_fin = new \DateTime($fechas['fecha_fin']);
            $fecha_inicio = new \DateTime($fechas['fecha_inicio']);

            $valores['fecha_inicio'] = $fechas['fecha_inicio'];
            $valores['fecha_fin'] = $fechas['fecha_fin'];

            //-- saldo anterior
            $saldoAcumuladoL =$this->vac_lab($id);
            $saldoAcumuladoC =$this->vac_cal($id);
            $valores['vac_acu_cal'] = $saldoAcumuladoC;
            $valores['vac_acu_lab'] = $saldoAcumuladoL;

    }else {  // si es primera vez

        if ($fecha_ingreso > $fecha_base){ //-- ingreso en este periodo


                $fechas = $this->calcularIntervalo($fecha_ingreso,null);
                $fecha_fin = new \DateTime($fechas['fecha_fin']);
                $fecha_inicio = new \DateTime($fechas['fecha_inicio']);
                $valores['fecha_inicio'] = $fechas['fecha_inicio'];
                $valores['fecha_fin'] = $fechas['fecha_fin'];


                //-- saldo anterior
                $valores['vac_acu_lab'] = $saldoAcumuladoL;
                $valores['vac_acu_cal'] = $saldoAcumuladoC;

        } else {  // ingreso antes de este periodo
            //-- sin soporte aun
        }
    }
    //anio
    $valores['anio'] = $fecha_inicio->format('Y');

            // no existe dias de antiguedad
                $valores['dias_ley_lab'] = 0;
                $valores['dias_ley_cal'] = 0;

                //-- dias por ley
                $diasCalendario=$this->diasTrancurridos($fecha_inicio,$fecha_fin);
                $diasLaborales=(22*$diasCalendario)/30;
                $diasLaborales =number_format($diasLaborales, 2, '.', ' ');
                $valores['vac_dias_cal'] = $diasCalendario;
                $valores['vac_dias_lab'] = $diasLaborales;

           // calculo de permisos
           $getPermisos=$this->getPermisos($id,$fechas['fecha_inicio'],$fechas['fecha_fin']);
           $totalPermisoCalendario =$getPermisos['tot_cal'];
           $totalPermisosLaborales =$getPermisos['tot_lab'];
           $valores['num_per_cal']= $totalPermisoCalendario;
           $valores['num_per_lab']= $totalPermisosLaborales;

           //-- sub total
           $valores['calculo_cal_diascal']=$diasCalendario - $totalPermisoCalendario;
           $valores['calculo_cal_diaslab']=$diasLaborales - $totalPermisosLaborales;
           $subTotalC =$valores['calculo_cal_diascal'];
           $subTotalL =$valores['calculo_cal_diaslab'];

        /** si la fecha de ingreso sumado un periodo es igual o menor
                * a la fecha actual permite guardar el periodo
                * de lo contrario no permite
                */
                if ($fecha_fin <= $fecha_actual){
                    $valores['guardar']=1;
                }else {
                    $valores['guardar']=0;
                }

                $valores['calculo_cal_salcal']=$subTotalC+$saldoAcumuladoC;
                $valores['calculo_cal_sallab']=$subTotalL+$saldoAcumuladoL;
    echo json_encode($valores);
 }


public function diasTrancurridos($fechaInicio,$fechaFinal){
  $fechaActual =  new \DateTime(date('Y-m-d'));
  if($fechaFinal<$fechaActual){
    //$intervalo = date_diff($fechaInicio,$fechaFinal);
    //$total = $intervalo->format('%a');
    //$dias =$total*30/365;
    //-- por defecto se inicia a 30
    $dias=30;
  }else {
    $intervalo = date_diff($fechaInicio,$fechaActual);
    $total = $intervalo->format('%a');
    //--meses sin contar la fecha inicial
    $meses = ( $intervalo->y * 12 ) + $intervalo->m;
    $diaIngreso =(int)$fechaInicio->format('d');
    $diasMesIngreso = 30-$diaIngreso+1;
    if($fechaActual->format('d')==30){ // mes completo
      $diasTotal = $diasMesIngreso + $meses*30;
    }else { // restamos un mes y sumamos los dias restantes
      $meses= $meses-1;
      $diasMesActual = $fechaActual->format('d');
      $diasTotal = $diasMesIngreso + $diasMesActual +$meses*30;
    }

    $dias =$diasTotal*30/360;
  }
  $dias = number_format($dias, 2, '.', ' ');
  return $dias;
}

    //intervalo de fechas para calculo periodico
    public function actionFechas($id) {
        $funcionario = $this->findFuncionario($id);
        //fecha base del sistema
        $fecha_base = new \DateTime('2015-01-01');
        $fecha_actual = new \DateTime(date('Y-m-d'));
        //$fecha_actual = new \DateTime(date('2019-m-d'));
        $fecha_origen = new \DateTime($funcionario->Fun_FechaIngreso);

        $query = Calculo::find();
        $calculoAnterior = $query->select('Cal_FechaFin')->from('calculo')->where(['Fun_Id' => $id])->orderBy('Cal_FechaFin DESC')->scalar();
        //$count = $query->select('count(*)')->from('calculo')->where(['Fun_Id' => $id])->orderBy('Cal_FechaFin DESC')->scalar();
        if ($calculoAnterior > 0) { // si ya tiene un calculo anterior
            //$fechas = $this->calcularIntervalo($id, $fecha_origen);
            $fechas = $this->calcularIntervalo($fecha_origen,$calculoAnterior);
            $fecha_fin = new \DateTime($fechas['fecha_fin']);
            $fecha_inicio = new \DateTime($fechas['fecha_inicio']);
            $anio_exacto = $fechas['fecha_exacta'];
            $dias = $this->diasAntiguedad($fecha_origen->format('Y'), $fecha_fin->format('Y'), $anio_exacto);
            $valores['fecha_inicio'] = $fechas['fecha_inicio'];
            $valores['anio'] = $fecha_inicio->format('Y');
            $valores['dias_ley_lab'] = $dias['dias_lab'];
            $valores['dias_ley_cal'] = $dias['dias_cal'];
            $valores['vac_acu_cal'] = $this->vac_cal($id);
            $valores['vac_acu_lab'] = $this->vac_lab($id);
            if ($fecha_fin < $fecha_actual) {
                $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
                $valores['tipo'] = 'calculo';
            } else {
                $valores['fecha_fin'] = $fecha_actual->format('Y-m-d');
                $valores['tipo'] = 'no calculado';
            }
        } else {// si no tiene calculo anterior empieza en 2015
            $fecha_inicio = new \DateTime($funcionario->Fun_FechaIngreso);

             if ($fecha_inicio > $fecha_base) {

            $fechas = $this->calcularIntervalo($fecha_origen,NULL);
            $fecha_inicio = new \DateTime($fechas['fecha_inicio']);
            $fecha_fin = new \DateTime($fechas['fecha_fin']);
            $anio_exacto = $fechas['fecha_exacta'];
            $valores['fecha_inicio'] = $fechas['fecha_inicio'];
                if ($fecha_fin < $fecha_actual) {
                    $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
                    $valores['anio'] = $fecha_fin->format('Y');
                    $valores['dias_ley_lab'] = '0';
                    $valores['dias_ley_cal'] = '0';
                    $valores['vac_acu_cal'] = '0';
                    $valores['vac_acu_lab'] = '0';
                    $valores['tipo'] = 'primer calculo';
                } else {
                    $dias = $this->diasAntiguedad($fecha_origen->format('Y'), $fecha_fin->format('Y'), $anio_exacto);
                    $valores['fecha_fin'] = $fecha_actual->format('Y-m-d');
                    $valores['anio'] = $fecha_actual->format('Y');
                    $valores['dias_ley_lab'] = $dias['dias_lab'];
                    $valores['dias_ley_cal'] = $dias['dias_cal'];
                    $valores['vac_acu_cal'] = $this->vac_cal($id);
                    $valores['vac_acu_lab'] = $this->vac_lab($id);
                    $valores['tipo'] = 'no calculado';
                }
            } else {
                $valores = $this->calculoHistorico($fecha_inicio, 'historico');
            }
        }
        echo json_encode($valores);
        //var_dump($diferencia);
    }

     /*
     * Calculo de intervalo cuando ya tuvo un calculo anterior
     */

    private function calcularIntervalo($fechaIngreso,$fechaUltCalculo) {

        if ($fechaUltCalculo==null){

         $fecha_inicio = $fechaIngreso;

        }else {
        
        $fechaUltimoCalculo = new \DateTime($fechaUltCalculo);
        $anioultimoCalculo = $fechaUltimoCalculo->format('Y');
        $fechainicioPeriodo = $anioultimoCalculo . "-" . $fechaIngreso->format('m') . "-" . $fechaIngreso->format("d");
        $fecha_inicio = new \DateTime($fechainicioPeriodo);
        
        }


        /**
        si inicio el 01 del anio
        */
        if ($fecha_inicio->format('m') == "01" && $fecha_inicio->format("d") == "01") {
            $anioPeriodo = $fecha_inicio->format('Y') + 1;
            $fecha_inicio->setDate($anioPeriodo, "01", "01");
            $fecha_final = $anioPeriodo . "-12-31";
            $fecha_fin = new \DateTime($fecha_final);
            $anio_exacto = true;
        } else {
            /**
             * “Un año es bisiesto si es divisible entre 4,
             * excepto aquellos divisibles entre 100 pero no entre 400.”
             */
             $intervalo = $this->getIntervalo($fecha_inicio);

            $fecha_fin = new \DateTime($fecha_inicio->format('Y-m-d'));
            $fecha_fin->add($intervalo);
            $anio_exacto = false;
        }
        $fechas['fecha_inicio'] = $fecha_inicio->format('Y-m-d');
        $fechas['fecha_fin'] = $fecha_fin->format('Y-m-d');
        $fechas['fecha_exacta'] = $anio_exacto;
        return $fechas;
    }

    public function getIntervalo($fecha_inicio){
      $anioPeriodo = $fecha_inicio->format('Y');
      $mesInicio = $fecha_inicio->format('m');
      if ($mesInicio >= 3) {
          $anioPeriodo = $fecha_inicio->format('Y') + 1;
          if ((($anioPeriodo % 4) == 0 && $anioPeriodo % 100 != 0) || $anioPeriodo % 400 == 0) {
              $intervalo = new \DateInterval('P365D'); // menos un dia
          } else {
              $intervalo = new \DateInterval('P364D'); // menos un dia
          }
      } else {
          if ((($anioPeriodo % 4) == 0 && $anioPeriodo % 100 != 0) || $anioPeriodo % 400 == 0) {
              $intervalo = new \DateInterval('P365D'); // menos un dia
          } else {
              $intervalo = new \DateInterval('P364D'); // menos un dia
          }
      }
      return $intervalo;
    }

    private function calculoHistorico($fecha_inicio, $parametro = null) {
        if ($fecha_inicio->format('m') == '01' and $fecha_inicio->format('d') == '01') {
            $valores['fecha_inicio'] = $fecha_inicio->format('Y-m-d');
            if ($parametro == 'historico') {
                $fecha_final = "2015-12-31";
            } else {
                $fecha_final = $fecha_inicio->format('Y') . "-" . "12-31";
            }
            $fecha_fin = new \DateTime($fecha_final);
            $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
        } else {
            $valores['fecha_inicio'] = $fecha_inicio->format('Y-m-d');
            if ($parametro == 'historico') {
                $nuevafecha = "2014-" . $fecha_inicio->format('m') . "-" . $fecha_inicio->format('d');
                $fecha_inicio = new \DateTime($nuevafecha);
                $intervalo = new \DateInterval('P364D');
                $fecha_fin = new \DateTime($fecha_inicio->format('Y-m-d'));
                $fecha_fin->add($intervalo);
                $valores['fecha_fin'] = $fecha_fin->format('Y-m-d');
            }
        }
        $valores['anio'] = $fecha_fin->format('Y'); // se usa el anio fin por ser el calculo inicial
        $valores['dias_ley_lab'] = '0';
        $valores['dias_ley_cal'] = '0';
        $valores['vac_acu_cal'] = '0';
        $valores['vac_acu_lab'] = '0';
        $valores['tipo'] = $parametro;
        return $valores;
    }

    private function diasAntiguedad($anio_ini, $anio_fin, $anio_completo) {

        $dias_cal = $anio_fin - $anio_ini - 5;
        $dias_lab = $dias_cal;

        if (($dias_cal > 6) && ($dias_cal <= 14)) {
            $dias_lab = $dias_cal - 2;
        } else if ($dias_cal >= 15) {
            $dias_lab = 11;
            $dias_cal = 15;
        } elseif ($dias_cal < 0) {
            $dias_cal = 0;
            $dias_lab = 0;
        }

        if ($anio_completo){ // sumo 1 dia
            if ($dias_cal == 15)
            {
            $valores['dias_lab'] = $dias_lab;
            $valores['dias_cal'] = $dias_cal;
            }    else {
            $valores['dias_lab'] = $dias_lab + 1;
            $valores['dias_cal'] = $dias_cal + 1;    
            }
            
        }else {  //-- calculo normal
            $valores['dias_lab'] = $dias_lab;
            $valores['dias_cal'] = $dias_cal;
        }
        
        return $valores;
    }

/**
* Calculo de dias de antiguedad 
* id : id del funcionario 
* fecha : fecha selecionada como final del perdio a calcular
*/
    public function actionDiasley($id, $fecha) {
        $fecha_base = new \DateTime($fecha);
        $funcionario = $this->findFuncionario($id);
        $fecha_origen = new \DateTime($funcionario->Fun_FechaIngreso);
        $valor = $fecha_base->format('Y') . '-' . $fecha_origen->format('m') . '-' . $fecha_origen->format('d');
        $fecha_com = new \DateTime($valor);
        $diferencia = $fecha_base->format('Y') - $fecha_origen->format('Y');
        if ($diferencia > 5) {
            if ($fecha_base >= $fecha_com) {
                $dias_cal = $fecha_base->format('Y') - $fecha_origen->format('Y') - 5;
            } else {
                $dias_cal = $fecha_base->format('Y') - $fecha_origen->format('Y') - 5;
            }
        } else {
            $dias_cal = 0;
        }
        $dias_lab = $dias_cal;
        if (($dias_cal > 6) && ($dias_cal <= 14)) {
            $dias_lab = $dias_cal - 2;
        } else if ($dias_cal >= 15) {
            $dias_lab = 11;
            $dias_cal = 15;
        } elseif ($dias_cal < 0) {
            $dias_cal = 0;
            $dias_lab = 0;
        }

        // condicionales para colaboradores que ingresaron el 01 - 01 de un periodo
        if ( ( $fecha_origen->format('m') == 01 ) &&  ( $fecha_origen->format('d') == 01 ) ){
            
            //-- controlamos si escogio fin de periodo 
            if ( ( $fecha_base->format('m') == 12 ) && ( $fecha_base->format('d') == 31 ) ) {
                $dias_cal = $dias_cal + 1;
                $dias_lab = $dias_lab + 1;
            }

        }else { //-- termina en otro mes
            //-- codigo
        }

        $valores['dias_cal'] = $dias_cal;
        $valores['dias_lab'] = $dias_lab;
        echo json_encode($valores);
    }

    public function actionTotal($id) {
        $saldo_cal = $this->vac_cal($id);
        $saldo_lab = $this->vac_lab($id);
        $valores['saldo_cal'] = $saldo_cal;
        $valores['saldo_lab'] = $saldo_lab;
        echo json_encode($valores);
    }

    public function vac_cal($id) {
        $total = 0;
        $query1 = Calculo::find();
        $calculo = $query1->select('sum(Cal_DiasCal)')->from('calculo')->where(['Fun_Id' => $id])->scalar();
        $query2 = Vacacion::find();
        $vacacion = $query2->select('sum(Vac_DiasCal)')->from('vacacion')->where(['Fun_Id' => $id])->scalar();
        $total = $calculo - $vacacion;
        return $total;
    }

    public function vac_lab($id) {
        $total = 0;
        $query1 = Calculo::find();
        $calculo = $query1->select('sum(Cal_DiasLab)')->from('calculo')->where(['Fun_Id' => $id])->scalar();
        $query2 = Vacacion::find();
        $vacacion = $query2->select('sum(Vac_DiasLab)')->from('vacacion')->where(['Fun_Id' => $id])->scalar();
        $total = $calculo - $vacacion;
        return $total;
    }

    public function dias_mes($mes, $anio) {
        $dias = 0;
        if ($mes <= 7) {
            if ($mes == 2) {
                if (($anio % 4) == 0)
                    $dias = 29;
                else {
                    $dias = 28;
                }
            } else {
                if (($mes % 2) == 0)
                    $dias = 30;
                else
                    $dias = 31;
            }
        }else {
            if (($mes % 2) == 0)
                $dias = 31;
            else
                $dias = 30;
        }
        return $dias;
    }

    /**
     * Finds the Calculo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calculo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Calculo::findOne($id)) !== null) {
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
        $model = ViewCalculo::find()->where(['Cal_Id' => $id])->one();
        if ($model !== null) {
            return $model;
            //echo $model->Cal_Id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
