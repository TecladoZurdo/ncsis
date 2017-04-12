<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_permiso".
 *
 * @property integer $Per_Id
 * @property string $Per_FechaInicio
 * @property string $Per_FechaFinal
 * @property integer $Per_Dias
 * @property string $Per_Horas
 * @property string $Per_Minutos
 * @property string $Per_Total
 * @property string $Fun_Codigo
 * @property string $Fun_Cedula
 * @property string $Fun_Nombres
 * @property string $Fun_Apellidos
 * @property string $Fun_FechaIngreso
 */
class ViewPermiso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_permiso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Per_Id', 'Per_Dias','Fun_Id'], 'integer'],
            [['Per_FechaInicio', 'Per_FechaFinal', 'Per_Dias', 'Per_Total', 'Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso'], 'required'],
            [['Per_Horas', 'Per_Minutos', 'Per_Total','Per_ValorCal','Per_ValorLab'], 'number'],
            [['Fun_FechaIngreso'], 'safe'],
            [['Per_FechaInicio', 'Per_FechaFinal', 'Fun_Codigo','Tiper_Nombre'], 'string', 'max' => 45],
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
            'Per_Id' => 'Tipo de Permiso',
            'Tiper_Nombre'=>'Tipo de Permiso',
            'Per_FechaInicio' => 'Fecha de Salida',
            'Per_FechaFinal' => 'Fecha de Retorno',
            'Per_DiasCal' => 'Días Calendario',
            'Per_DiasLab'=>'Días Laborables',
            'Per_Horas' => 'Horas',
            'Per_Minutos' => 'Minutos',
            'Per_ValorCal' => 'Valor en dias calendario',
            'Per_ValorLab' => 'Valor en dias laborales',
            'Per_Total' => 'Total(Valor en Días)',
            'Fun_Id' => 'Id',
            'Fun_Codigo' => 'Código',
            'Fun_Cedula' => 'Cédula',
            'Fun_Nombres' => 'Nombres',
            'Fun_Apellidos' => 'Apellidos',
            'Fun_FechaIngreso' => 'Fecha de Ingreso',
        ];
    }
}
