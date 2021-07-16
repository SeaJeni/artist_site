<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `backend\models\Project`.
 * @property Customer $customer
 * @property Type $type
 */
class ProjectSearch extends Project
{
    public $type;
    public $customer;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['name'], 'safe'],
            [['cost'], 'double'],
            [['type', 'customer'], 'safe'],
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
        $query = Project::find();
        $query->joinWith(['type']);
        $query->joinWith(['customer']);
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
            //'id' => $this->id,
            // 'stage_id' => $this->stage_id,

            //'type_id' => $this->type_id,
//            'manager_id' => $this->manager_id,
//            'main_artist_id' => $this->main_artist_id,
//            'artist_id' => $this->artist_id,
//            'start_time' => $this->start_time,
//            'end_time' => $this->end_time,
//            'deadline' => $this->deadline,
              'cost' => $this->cost,
//            'customer_id' => $this->customer_id,

        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
            //  ->andFilterWhere(['like', 'status', $this->status])
            // ->andFilterWhere(['like', 'payment_status', $this->payment_status])
            ->andFilterWhere(['like', Type::tableName() . '.name', $this->type])
            ->andFilterWhere(['like', Customer::tableName() . '.last_name', $this->customer]);

        return $dataProvider;
    }
}
