<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Liquidacion;

/**
 * LiquidacionSearch represents the model behind the search form about `app\models\Liquidacion`.
 */
class LiquidacionSearch extends Liquidacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['liq_id', 'Liq_Dias', 'Vac_Id'], 'integer'],
            [['Liq_FechaInicio', 'Liq_FechaFinal'], 'safe'],
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
        $query = Liquidacion::find();

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
            'liq_id' => $this->liq_id,
            'Liq_FechaInicio' => $this->Liq_FechaInicio,
            'Liq_FechaFinal' => $this->Liq_FechaFinal,
            'Liq_Dias' => $this->Liq_Dias,
            'Vac_Id' => $this->Vac_Id,
        ]);

        return $dataProvider;
    }
}
