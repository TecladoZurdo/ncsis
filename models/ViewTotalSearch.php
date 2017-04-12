<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewTotal;

/**
 * CalculoSearch represents the model behind the search form about `app\models\Calculo`.
 */
class ViewTotalSearch extends ViewTotal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['codigo', 'cedula', 'nombres', 'apellidos', 'fecha_ingreso'], 'safe'],
            [['CalDiasCal','CalDiasLab', 'VacCal','VacLab', 'TotCal','TotLab','DifCal','DifLab','Per_ValorCal','Per_ValorLab', 'Per_Total'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = ViewTotal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
                ->andFilterWhere(['like', 'fecha_ingreso', $this->fecha_ingreso])
                ->andFilterWhere(['like', 'CalDiasCal', $this->CalDiasCal])
                ->andFilterWhere(['like', 'CalDiasLab', $this->CalDiasLab])
                ->andFilterWhere(['like', 'VacCal', $this->VacCal])
                ->andFilterWhere(['like', 'apellidos', $this->VacLab])
                ->andFilterWhere(['like', 'VacLab', $this->TotCal])
                ->andFilterWhere(['like', 'TotLab', $this->TotLab])
                ->andFilterWhere(['like', 'DifLab', $this->DifLab])
                ->andFilterWhere(['like', 'DifCal', $this->DifCal])
                ->andFilterWhere(['like', 'Per_ValorLab', $this->Per_ValorLab])
                ->andFilterWhere(['like', 'Per_ValorCal', $this->Per_ValorCal])
                ->andFilterWhere(['like', 'Per_Total', $this->Per_Total]);

        return $dataProvider;
    }
}
