<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacacion;

/**
 * VacacionSearch represents the model behind the search form about `app\models\Vacacion`.
 */
class VacacionSearch extends Vacacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Vac_Id', 'Fun_Id'], 'integer'],
            [['Vac_FechaInicio', 'Vac_FechaFinal', 'Vac_DiasCal','Vac_DiasLab'], 'safe'],
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
        $query = Vacacion::find();

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
            'Fun_Id' => $this->Fun_Id,
        ]);

        $query->andFilterWhere(['like', 'Vac_FechaFinal', $this->Vac_FechaFinal])
            ->andFilterWhere(['like', 'Vac_DiasCal', $this->Vac_DiasCal])
                ->andFilterWhere(['like', 'Vac_DiasLab', $this->Vac_DiasLab]);

        return $dataProvider;
    }
}
