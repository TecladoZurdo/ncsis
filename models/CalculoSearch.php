<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Calculo;

/**
 * CalculoSearch represents the model behind the search form about `app\models\Calculo`.
 */
class CalculoSearch extends Calculo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_Id', 'Cal_DiasCal','Cal_DiasLab', 'Cal_Anio', 'Fun_Id'], 'integer'],
            [['Cal_SalCal','Cal_SalLab'],'number'],
            [['Cal_FechaInicio', 'Cal_FechaFin'], 'safe'],
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
        $query = Calculo::find();

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
            'Cal_Id' => $this->Cal_Id,
            'Cal_FechaInicio' => $this->Cal_FechaInicio,
            'Cal_FechaFin' => $this->Cal_FechaFin,
            'Cal_DiasLab' => $this->Cal_DiasCal,
            'Cal_DiasCal'=>  $this->CalDiasLab,
            'Cal_SalCal'=>  $this->CalSalCal,
            'Cal_SalLab'=>  $this->CalSalLab,
            'Cal_Anio' => $this->Cal_Anio,
            'Fun_Id' => $this->Fun_Id,
        ]);

        return $dataProvider;
    }
}
