<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewPermiso;

/**
 * PermisosSearch represents the model behind the search form about `app\models\Permisos`.
 */
class ViewPermisoSearch extends ViewPermiso {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Per_Id', 'Per_Dias'], 'integer'],
            [['Per_FechaInicio', 'Per_FechaFinal','Tiper_Nombre'], 'safe'],
            [['Per_Horas', 'Per_Minutos', 'Per_Total','Per_ValorCal','Per_ValorLab'], 'number'],
            [['Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = ViewPermiso::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Per_Id' => $this->Per_Id,
            'Per_DiasCal' => $this->Per_Dias,
            'Per_Horas' => $this->Per_Horas,
            'Per_Minutos' => $this->Per_Minutos,
            'Per_Total' => $this->Per_Total,
            'Per_ValorCal' => $this->Per_ValorCal,
            'Per_ValorLab' => $this->Per_ValorLab,
        ]);

        $query->
                //andFilterWhere(['like', 'Per_FechaInicio', $this->Per_FechaInicio])
                //->andFilterWhere(['like', 'Per_FechaFinal', $this->Per_FechaFinal])
                andFilterWhere(['like', 'Fun_Codigo', $this->Fun_Codigo])
                ->andFilterWhere(['like', 'Fun_Cedula', $this->Fun_Cedula])
                ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
                ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos])
                ->andFilterWhere(['like', 'Tiper_Nombre', $this->Tiper_Nombre]);
        if($this->Per_FechaInicio!='' and $this->Per_FechaFinal){
            $query->andWhere(['between','Per_FechaInicio',$this->Per_FechaInicio,  $this->Per_FechaFinal]);
        }
        

        return $dataProvider;
    }

}
