<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Term;

/**
 * TermSearch represents the model behind the search form of `backend\models\Term`.
 */
class TermSearch extends Term
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stage_id', 'project_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Term::find();

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
            'stage_id' => $this->stage_id,
            'project_id' => $this->project_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        return $dataProvider;
    }
}
