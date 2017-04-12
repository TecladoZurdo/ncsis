<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoPermiso".
 *
 * @property integer $Tiper_Id
 * @property string $Tiper_Nombre
 *
 * @property Permisos[] $permisos
 */
class TipoPermiso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipopermiso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tiper_Nombre'], 'required'],
            [['Tiper_Nombre'], 'string', 'max' => 45],
            [['descuentoVacaciones'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
           'Tiper_Id' => 'Item',
           'Tiper_Nombre' => 'Tipo de Permiso',
           'descuentoVacaciones'=>'Descuento a Vacaciones'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermisos()
    {
        return $this->hasMany(Permisos::className(), ['Tiper_Id' => 'Tiper_Id']);
    }
}
