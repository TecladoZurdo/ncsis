<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Vacacion".
 *
 * @property integer $Vac_Id
 * @property string $Vac_FechaInicio
 * @property string $Vac_FechaFinal
 * @property string $Vac_Dias
 * @property integer $Fun_Id
 *
 * @property Funcionario $fun
 */
class Vacacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Vacacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Vac_FechaInicio', 'Vac_FechaFinal', 'Vac_DiasCal','Vac_DiasLab', 'Fun_Id'], 'required'],
            [['Vac_FechaInicio'], 'safe'],
            [['Fun_Id'], 'integer'],
            [['Vac_FechaFinal', 'Vac_Dias'], 'string', 'max' => 45]
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
            'Vac_DiasCal' => 'Días Calendario a Tomar',
            'Vac_DiasLab' => 'Días Laborables a Tomar',
            'Fun_Id' => 'Fun  ID',
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
