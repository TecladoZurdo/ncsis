<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewCalculo;

/**
 * CalculoSearch represents the model behind the search form about `app\models\Calculo`.
 */
class ViewCalculoSearch extends ViewCalculo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_Anio'], 'integer'],
            [['Cal_DiasCal','Cal_DiasLab','TotPerCal','TotPerLab','Dias_Res_Cal','Dias_Res_Lab'], 'number'],
            [['Cal_FechaInicio', 'Cal_FechaFin','TotPerCal','TotPerLab','Dias_Res_Cal','Dias_Res_Lab'], 'safe'],
            [['Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos'], 'safe'],
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
        $query = ViewCalculo::find();

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
            'Cal_FechaInicio' => $this->Cal_FechaInicio,
            'Cal_FechaFin' => $this->Cal_FechaFin,
            'Cal_DiasCal' => $this->Cal_DiasCal,
            'Cal_DiasLab' => $this->Cal_DiasLab,
            'Cal_Anio' => $this->Cal_Anio,
            'TotPerCal' => $this->TotPerCal,
            'TotPerLab' => $this->TotPerLab,
            'Dias_Res_Cal' => $this->Dias_Res_Cal,
            'Dias_Res_Lab' => $this->Dias_Res_Lab
        ]);
        
        $query->andFilterWhere(['like', 'Fun_Codigo', $this->Fun_Codigo])
            ->andFilterWhere(['like', 'Fun_Cedula', $this->Fun_Cedula])
            ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
            ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos]);

        return $dataProvider;
    }
}
