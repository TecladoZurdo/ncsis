<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Calculo".
 *
 * @property integer $Cal_Id
 * @property string $Cal_FechaInicio
 * @property string $Cal_FechaFin
 * @property integer $Cal_Dias
 * @property integer $Cal_Anio
 * @property integer $Fun_Id
 *
 * @property Funcionario $fun
 */
class Calculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_FechaInicio', 'Cal_FechaFin', 'Cal_DiasCal','Cal_DiasLab','Cal_SalCal','Cal_SalLab', 'Cal_Anio', 'Fun_Id'], 'required'],
            [['Cal_FechaInicio', 'Cal_FechaFin'], 'safe'],
            [['Cal_Anio', 'Fun_Id'], 'integer'],
            [['Cal_DiasCal','Cal_DiasLab','Cal_SalCal','Cal_SalLab'],'number'],
            [['activo'],'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Cal_Id' => 'Item',
            'Cal_FechaInicio' => 'Fecha Inicio de Período',
            'Cal_FechaFin' => 'Fecha Fin de Período',
            //Total Días Generados - Permisos (Laborales); ojo ya no va
            'Cal_DiasCal' => 'Subtotal (días calculados - descuentos)',
            'Cal_DiasLab'=>'Subtotal (días calculados - descuentos)',
            'Cal_SalCal'=>'Total (subtotal + saldo anterior)',
            'Cal_SalLab'=>'Total (subtotal + saldo anterior)',
            'Cal_Anio' => 'Año de Cálculo',
            'Fun_Id' => 'Funcionario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFun()
    {
        return $this->hasOne(Funcionario::className(), ['Fun_Id' => 'Fun_Id']);
    }
}
