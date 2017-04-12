<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Permisos;

/**
 * PermisosSearch represents the model behind the search form about `app\models\Permisos`.
 */
class PermisosSearch extends Permisos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Per_Id', 'Per_Dias', 'Fun_Id', 'Tiper_Id'], 'integer'],
            [['Per_FechaInicio', 'Per_FechaFinal'], 'safe'],
            [['Per_Horas', 'Per_Minutos', 'Per_Total', 'Per_ValorCal','Per_ValorLab'], 'number'],
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
        $query = Permisos::find();

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
            'Per_Dias' => $this->Per_Dias,
            'Per_Horas' => $this->Per_Horas,
            'Per_Minutos' => $this->Per_Minutos,
            'Per_Total' => $this->Per_Total,
            'Per_ValorCal' => $this->Per_ValorCal,
            'Per_ValorLab'=>  $this->Per_ValorLab,
            'Fun_Id' => $this->Fun_Id,
            'Tiper_Id' => $this->Tiper_Id,
        ]);

        $query->andFilterWhere(['like', 'Per_FechaInicio', $this->Per_FechaInicio])
            ->andFilterWhere(['like', 'Per_FechaFinal', $this->Per_FechaFinal]);

        return $dataProvider;
    }
}
