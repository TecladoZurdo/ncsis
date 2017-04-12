<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewVacacion;

/**
 * VacacionSearch represents the model behind the search form about `app\models\Vacacion`.
 */
class ViewVacacionSearch extends ViewVacacion {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Vac_Id'], 'integer'],
            [['Vac_FechaInicio', 'Vac_FechaFinal', 'Vac_DiasCal','Vac_DiasLab','Dias_Res_Cal','Dias_Cal','permisos'], 'safe'],
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
        $query = ViewVacacion::find();

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
            'Vac_Id' => $this->Vac_Id,
            'Vac_FechaInicio' => $this->Vac_FechaInicio,
        ]);

        $query->andFilterWhere(['like', 'Vac_FechaFinal', $this->Vac_FechaFinal])
                ->andFilterWhere(['like', 'Vac_Dias_Cal', $this->Vac_DiasLab])
                ->andFilterWhere(['like', 'Vac_Dias_Cal', $this->Vac_DiasLab])
                ->andFilterWhere(['like', 'Dias_Res_Cal', $this->Dias_Res_Cal])
                ->andFilterWhere(['like', 'Dias_Cal', $this->Dias_Cal])
                ->andFilterWhere(['like', 'permisos', $this->permisos])
                ->andFilterWhere(['like', 'Fun_Codigo', $this->Fun_Codigo])
                ->andFilterWhere(['like', 'Fun_Cedula', $this->Fun_Cedula])
                ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
                ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos]);

        return $dataProvider;
    }

}
