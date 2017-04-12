<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calvac".
 *
 * @property integer $Cal_Id
 * @property string $Cal_FechaInicio
 * @property string $Cal_FechaFin
 * @property string $Cal_Dias
 * @property string $Cal_Anio
 * @property string $Cal_Total
 * @property integer $Fun_Id
 *
 * @property Funcionario $fun
 */
class Calvac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calvac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_FechaInicio', 'Cal_FechaFin', 'Cal_Dias', 'Cal_Anio', 'Cal_Total', 'Fun_Id'], 'required'],
            [['Fun_Id'], 'integer'],
            [['Cal_FechaInicio', 'Cal_FechaFin'], 'safe'],
            [['Cal_Dias','Cal_Ley','Cal_Saldo','Cal_Permisos'], 'number'],
            [['Cal_Anio', 'Cal_Total'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Cal_Id' => 'Item',
            'Cal_FechaInicio' => 'Fecha Inicio',
            'Cal_FechaFin' => 'Fecha Fin',
            'Cal_Dias' => 'Días Generados',
            'Cal_Anio' => 'Año de Cálculo',
            'Cal_Total' => ' Total',
            'Cal_Ley'=>'Antigüedad',
            'Cal_Saldo'=>'Saldo Anterior',
            'Cal_Permisos'=>'Descuentos',
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
