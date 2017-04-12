<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_vacacion".
 *
 * @property integer $Vac_Id
 * @property string $Vac_FechaInicio
 * @property string $Vac_FechaFinal
 * @property string $Vac_Dias
 * @property string $Fun_Codigo
 * @property string $Fun_Cedula
 * @property string $Fun_Nombres
 * @property string $Fun_Apellidos
 * @property string $Fun_FechaIngreso
 */
class ViewVacacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_vacacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Vac_Id'], 'integer'],
            [['Vac_FechaInicio', 'Vac_FechaFinal', 'Vac_Dias', 'Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso'], 'required'],
            [['Vac_FechaInicio', 'Vac_FechaFinal', 'Fun_FechaIngreso'], 'safe'],
            [['Vac_DiasCal','Vac_DiasLab','Dias_Res_Cal','Dias_Cal','permisos'], 'number'],
            [['Fun_Codigo'], 'string', 'max' => 45],
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
            'Vac_Id' => 'Item',
            'Vac_FechaInicio' => 'Fecha de Salida',
            'Vac_FechaFinal' => 'Fecha de Retorno',
            'Vac_DiasLab' => 'Días Vacaciones Laborables',
            'Vac_DiasCal' => 'Días Vacaciones Calendario',
            'Fun_Codigo' => 'Código',
            'Fun_Cedula' => 'Cédula',
            'Fun_Nombres' => 'Nombres',
            'Fun_Apellidos' => 'Apellidos',
            'Fun_FechaIngreso' => 'Fecha Ingreso',
            'Dias_Res_Cal'=>'Días Restantes',
            'Dias_Cal'=>'Dias Calculados',
            'permisos'=>'Total Permisos'
        ];
    }
}
