<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "Permisos".
 *
 * @property integer $Per_Id
 * @property string $Per_FechaInicio
 * @property string $Per_FechaFinal
 * @property integer $Per_Dias
 * @property string $Per_Horas
 * @property string $Per_Minutos
 * @property string $Per_Total
 * @property string $Per_Valor
 * @property integer $Fun_Id
 * @property integer $Tiper_Id
 *
 * @property Funcionario $fun
 * @property TipoPermiso $tiper
 */
class Permisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permisos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Per_FechaInicio', 'Per_FechaFinal', 'Per_Dias', 'Per_Total', 'Fun_Id', 'Tiper_Id'], 'required'],
            [['Per_Dias', 'Fun_Id', 'Tiper_Id'], 'integer'],
            [[ 'Per_Total', 'Per_ValorCal','Per_ValorLab'], 'number'],
            [['Per_FechaInicio', 'Per_FechaFinal'], 'string', 'max' => 45],
            [['Per_Horas'],'number','max'=>40],
            [['Per_Minutos'],'number','max'=>60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Per_Id' => 'Tipo de Permiso',
            'Per_FechaInicio' => 'Fecha de Salida',
            'Per_FechaFinal' => 'Fecha de Retorno',
            'Per_Dias' => 'Permiso en Días',
            'Per_Horas' => 'Permiso en Horas',
            'Per_Minutos' => 'Permiso en Minutos',
            'Per_Total' => 'Suma Total (Días, Horas y Minutos)',
            'Per_ValorCal' => 'Permisos Calendario',
            'Per_ValorLab' => 'Permisos Laborales',
            'Fun_Id' => 'Fun  ID',
            'Tiper_Id' => 'Tipo de Permiso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(Funcionario::className(), ['Fun_Id' => 'Fun_Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiper()
    {
        return $this->hasOne(TipoPermiso::className(), ['Tiper_Id' => 'Tiper_Id']);
    }
    
    public static function getListaPermisos(){
        $opciones= TipoPermiso::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'Tiper_Id', 'Tiper_Nombre');
    }
}
