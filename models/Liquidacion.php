<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Liquidacion".
 *
 * @property integer $liq_id
 * @property string $Liq_FechaInicio
 * @property string $Liq_FechaFinal
 * @property integer $Liq_Dias
 * @property integer $Vac_Id
 *
 * @property Vacaciones $vac
 */
class Liquidacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Liquidacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Liq_FechaInicio', 'Liq_FechaFinal'], 'safe'],
            [['Liq_Dias', 'Vac_Id'], 'integer'],
            [['Vac_Id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'liq_id' => 'Item',
            'Liq_FechaInicio' => 'Fecha Inicio de Cálculo',
            'Liq_FechaFinal' => 'Fecha Fin de Cálculo',
            'Liq_Dias' => 'Días',
            'Vac_Id' => 'Vacaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVac()
    {
        return $this->hasOne(Vacaciones::className(), ['Vac_Id' => 'Vac_Id']);
    }
}
