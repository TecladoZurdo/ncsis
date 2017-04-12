<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewCalculoVacaciones;
/**
 * Description of ViewCalculoVacacionesSearch
 *
 * @author efrain
 */
class ViewCalculoVacacionesSearch extends ViewCalculoVacaciones {
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fun_Nombres', 'Fun_Apellidos'], 'safe']
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
        $query = ViewCalculoVacaciones::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
       
            return $dataProvider;
        }

        $query
                 ->andFilterWhere(['like', 'Fun_Apellidos', $this->Fun_Apellidos])
                ->andFilterWhere(['like', 'Fun_Nombres', $this->Fun_Nombres])
                
               ;

        return $dataProvider;
    }
}
