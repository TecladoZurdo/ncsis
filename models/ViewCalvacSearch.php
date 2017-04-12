<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewCalvac;

/**
 * CalculoSearch represents the model behind the search form about `app\models\Calculo`.
 */
class ViewCalvacSearch extends ViewCalvac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cal_Anio'], 'integer'],
            [['Cal_Dias','Cal_Total','Cal_Ley','Cal_Saldo','Cal_Permisos'], 'number'],
            [['Cal_FechaInicio', 'Cal_FechaFin','Cal_Dias','Cal_Total'], 'safe'],
            [['Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos','Fun_FechaIngreso'], 'safe'],
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
        $query = ViewCalvac::find();

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
            'Cal_Dias' => $this->Cal_Dias,
            'Cal_Total' => $this->Cal_Total,
            'Cal_Anio' => $this->Cal_Anio,
            'Cal_Ley'=>$this->Cal_Ley,
            'Cal_Saldo'=>$this->Cal_Saldo,
            'Cal_Permisos'=>$this->Cal_Permisos
        ]);
        
        $query->andFilterWhere(['like', 'Fun_Codigo', $this->Fun_Codigo])
            ->andFilterWhere(['like', 'Fun_Cedula', $this->Fun_Cedula])
            ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
            ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos]);

        return $dataProvider;
    }
}
