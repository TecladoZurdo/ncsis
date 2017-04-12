<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_calculo".
 *
 * @property string $Cal_FechaInicio
 * @property string $Cal_FechaFin
 * @property string $Cal_Dias
 * @property integer $Cal_Anio
 * @property string $Fun_Codigo
 * @property string $Fun_Cedula
 * @property string $Fun_Nombres
 * @property string $Fun_Apellidos
 * @property string $Fun_FechaIngreso
 */
class ViewCalvac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_calvac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_FechaInicio', 'Cal_FechaFin', 'Cal_Dias', 'Cal_Anio', 'Cal_Total','Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso'], 'required'],
            [['Cal_FechaInicio', 'Cal_FechaFin', 'Fun_FechaIngreso'], 'safe'],
            [['Cal_Dias','Cal_Total','Cal_Ley','Cal_Saldo','Cal_Permisos'], 'number'],
            [['Cal_Anio'], 'integer'],
            [['Fun_Codigo'], 'string', 'max' => 4],
            [['Fun_Cedula'], 'string', 'max' => 10],
            [['Fun_Nombres', 'Fun_Apellidos'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Cal_FechaInicio' => 'Fecha Inicio de Período',
            'Cal_FechaFin' => 'Fecha Fin de Período',
            'Cal_Dias' => 'Días Devengados',
            'Cal_Anio' => 'Año Calculado',
            'Cal_Total' => 'Total',
            'Cal_Ley'=>'Antigüedad',
            'Cal_Saldo'=>'Saldo Anterior',
            'Cal_Permisos'=>'Descuentos',
            'Fun_Codigo' => 'Código',
            'Fun_Cedula' => 'Cédula',
            'Fun_Apellidos' => 'Apellidos',
            'Fun_Nombres' => 'Nombres',
            'Fun_FechaIngreso' => 'Fecha de Ingreso'
            //'dias_res'=>'Días Restantes'
        ];
    }
    
    
}
