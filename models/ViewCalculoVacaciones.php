<?php

namespace app\models;
use Yii;
/**
 * Description of ViewCalculoVacaciones
 */
/**
 * clase para la vista "viewCalculoVacaciones
 *
 * @property string $Fun_Apellidos  apellido del trabajador
 * @property string $Fun_Nombres  nombre del trabajador
 * @property date $iniperiodo fecha de ingreso al trabajo pero con el anio correcto
 * @property integer $antiguedad cantidad de dias que tiene por antiguedad
 * @property integer $diasdevengados Description
 */
class ViewCalculoVacaciones extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'viewcalculovacaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
    return [
        [['Fun_Apellidos','Fun_Nombres'],'string','max'=>400],
        [['Fun_Cedula'],'string','max'=>10],
        [['iniperiodo','finperiodo','fechaactual'],'date','format'=>'yy-m-d'],
        ['loep'],
        [['antiguedad','descuentos','descuentoslaborables','saldoanterior','saldoanteriorLab','total','diasdevengados'],'integer']
    ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
           'Fun_Apellidos' => 'Apellidos',
           'Fun_Nombres' => 'Nombres' ,
           'Fun_Cedula' => 'Cédula',
           'iniperiodo'=>'Inicio de Período',
            'fechaactual'=>'Fecha Actual',
           'finperiodo'=>'Fin de Período',
            'antiguedad'=>'Antiguedad',
            'loep'=>'LOEP',
             'diasdevengados'=>'Días Proporcionales 2017',
             'saldoanterior'=>'Saldo Anterior',
            'descuentos'=>'Permisos Otorgados',
           #  'saldoanteriorLab'=>'Saldo Anterior Laboral',
           # 'descuentoslaborables'=>'Descuentos Laboral',
            'total'=>'Saldo a Favor'
        ];
    }
}
