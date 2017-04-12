<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Funcionario".
 *
 * @property integer $Fun_Id
 * @property string $Fun_Codigo
 * @property string $Fun_Cedula
 * @property string $Fun_Nombres
 * @property string $Fun_Apellidos
 * @property string $Fun_FechaIngreso
 * @property string $Fun_Estado
 * @property integer $Fun_VacAcumuladas
 *
 * @property Permisos[] $permisos
 * @property Vacaciones[] $vacaciones
 */
class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso', 'Fun_Estado'], 'required', 'message'=>'Debe ingresar un dato'],
            [['Fun_FechaIngreso'], 'safe'],
            [['Fun_VacAcumuladas'], 'integer'],
            [['Fun_Codigo'], 'string', 'max' => 4],
            [['Fun_Codigo'], 'string', 'min' => 4],
            [['Fun_Cedula'], 'string', 'max' => 10],
            [['Fun_Cedula'], 'string', 'min' => 10],
            [['Fun_Nombres', 'Fun_Apellidos'], 'string', 'max' => 200],
            [['Fun_Cedula'], 'unique'],
            [['Fun_Codigo'], 'unique'],
            [['Fun_Codigo','Fun_Cedula'],'match','pattern'=>'/^[0-9]*$/'],
            [['Fun_Nombres','Fun_Apellidos'],'match','pattern'=>'/^[A-Za-z ]*$/'],
            [['losep'],'boolean']
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           'Fun_Id' => 'Item',
            'Fun_Codigo' => 'Código',
            'Fun_Cedula' => 'Cédula',
            'Fun_Apellidos' => 'Apellidos',
            'Fun_Nombres' => 'Nombres',
            'Fun_FechaIngreso' => 'Fecha de Ingreso',
            'Fun_Estado' => 'Estado',
            'Fun_VacAcumuladas' => 'Vacaciones Históricas',
            'losep' => 'El funcionario rige bajo la LOSEP'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permisos::className(), ['Fun_Id' => 'Fun_Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacaciones()
    {
        return $this->hasMany(Vacaciones::className(), ['Fun_Id' => 'Fun_Id']);
    }
    
    public static function getListaEstado() {
        $opciones = ['0' => ['estado_codigo' => 'activo', 'estado_nombre' => 'activo'],
            '1' => ['estado_codigo' => 'pasivo', 'estado_nombre' => 'pasivo']];
        return ArrayHelper::map($opciones, 'estado_codigo', 'estado_nombre');
    }
    
}
