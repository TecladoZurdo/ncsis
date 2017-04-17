<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Funcionario;

/**
 * FuncionarioSearch represents the model behind the search form about `app\models\Funcionario`.
 */
class FuncionarioSearch extends Funcionario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fun_Id', 'Fun_VacAcumuladas'], 'integer'],
            [['Fun_Codigo', 'Fun_Cedula', 'Fun_Nombres', 'Fun_Apellidos', 'Fun_FechaIngreso', 'Fun_Estado'], 'safe'],
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
        $query = Funcionario::find();

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
            'Fun_Id' => $this->Fun_Id,
            'Fun_FechaIngreso' => $this->Fun_FechaIngreso,
            'Fun_VacAcumuladas' => $this->Fun_VacAcumuladas,
        ]);

        $query->andFilterWhere(['like', 'Fun_Codigo', $this->Fun_Codigo])
            ->andFilterWhere(['like', 'Fun_Cedula', $this->Fun_Cedula])
            ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
            ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos])
            ->andFilterWhere(['like', 'Fun_Estado', $this->Fun_Estado]);

        return $dataProvider;
    }
    
    
    public function autocomplete($filtro) {
        $query = Funcionario::find();
        
        $query->orfilterWhere(['like', 'Fun_Codigo', $filtro]);
        $query->orfilterWhere(['like', 'Fun_Cedula', $filtro])
                ->orfilterWhere(['like', 'Fun_Nombres', $filtro])
                ->orfilterWhere(['like', 'Fun_Apellidos', $filtro]);
        //$query->andFilterWhere(['!=','participante_codigo',  Yii::$app->user->identity->participante_codigo]);
        //$query->andFilterWhere(['!=','participante_perfil', 'admin']);
        //$query->andFilterWhere(['!=','participante_perfil', 'superadmin']);
        $funcionarios = $query->all();
        if (count($funcionarios) > 0) {
            foreach ($funcionarios as $funcionario) {
                $new_row['label'] = $funcionario->Fun_Nombres . " " . $funcionario->Fun_Apellidos;
                $new_row['value'] = $funcionario->Fun_Cedula;
                $new_row['id'] = $funcionario->Fun_Id;
                $new_row['fecha']=$funcionario->Fun_FechaIngreso;
                $new_row['codigo']=$funcionario->Fun_Codigo;
                $new_row['estado']=$funcionario->Fun_Estado;
                $new_row['losep']=$funcionario->losep;
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
        }
        else{
            $new_row['label']='Sin resultados';
            $new_row['value']='';
            $new_row['id']='';
            $row_set[]=$new_row;
            echo json_encode($row_set);
        }
    }
}
