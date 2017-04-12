<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Calvac;

/**
 * CalvacSearch represents the model behind the search form about `app\models\Calvac`.
 */
class CalvacSearch extends Calvac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_Id', 'Fun_Id'], 'integer'],
            [['Cal_FechaInicio', 'Cal_FechaFin', 'Cal_Anio', 'Cal_Total'], 'safe'],
            [['Cal_Dias','Cal_Ley','Cal_Saldo'], 'number'],
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
        $query = Calvac::find();

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
            'Cal_Dias' => $this->Cal_Dias,
            'Cal_Ley'=>  $this->Cal_Ley,
            'Cal_Saldo'=>  $this->Cal_Saldo,
            'Cal_Permisos'=>  $this->Cal_Permisos,
            'Fun_Id' => $this->Fun_Id,
        ]);

        $query->andFilterWhere(['like', 'Cal_Anio', $this->Cal_Anio])
            ->andFilterWhere(['like', 'Cal_Total', $this->Cal_Total]);

        return $dataProvider;
    }
}
