<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vuelo;

/**
 * VueloSearch represents the model behind the search form about `app\models\Vuelo`.
 */
class VueloSearch extends Vuelo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orig_id', 'dest_id', 'comp_id'], 'integer'],
            [['id_vuelo', 'salida', 'llegada'], 'safe'],
            [['plazas', 'precio'], 'number'],
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
        $query = Vuelo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'orig_id' => $this->orig_id,
            'dest_id' => $this->dest_id,
            'comp_id' => $this->comp_id,
            'salida' => $this->salida,
            'llegada' => $this->llegada,
            'plazas' => $this->plazas,
            'precio' => $this->precio,
        ]);

        $query->andFilterWhere(['like', 'id_vuelo', $this->id_vuelo]);

        return $dataProvider;
    }
}
