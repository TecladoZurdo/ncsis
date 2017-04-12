<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_total".
 *
 * @property string $codigo
 * @property string $cedula
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_ingreso
 * @property string $calculado
 * @property string $vacaciones
 * @property string $total
 * @property string $permisos
 */
class ViewTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_total';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'cedula', 'nombres', 'apellidos', 'fecha_ingreso'], 'required'],
            [['fecha_ingreso'], 'safe'],
            [['CalDiasCal','CalDiasLab', 'VacCal','VacLab','TotCal','TotLab', 'DifCal','DifLab','Per_ValorCal','Per_ValorLab', 'Per_Total'], 'number'],
            [['codigo'], 'string', 'max' => 45],
            [['cedula'], 'string', 'max' => 10],
            [['nombres', 'apellidos'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Código',
            'cedula' => 'Cédula',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fecha_ingreso' => 'Fecha de Ingreso',
            'CalDiasCal' => 'Días Calculados Calendario',
            'CalDiasLab' => 'Días Calculados Laborales',
            'DifCal' => 'Diferencia Calendario',
            'DifLab' => 'Diferencia Laborales',
            'VacCal' => 'Vacaciones Calendario',
            'VacLab' => 'Vacaciones Laborales',
            'TotCal' => 'Total Calendario',
            'Totlab' => 'Total Laborales',
            'Per_ValorCal' => 'Permisos Calendario',
            'Per_ValorLab' => 'Permisos Laborales',
            'Per_Total' => 'Permisos',
        ];
    }
}
