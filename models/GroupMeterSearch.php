<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GroupMeter;

/**
 * GroupMeterSearch represents the model behind the search form of `app\models\GroupMeter`.
 */
class GroupMeterSearch extends GroupMeter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'group_id'], 'integer'],
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
        $query = GroupMeter::find();

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
            'meter_id' => $this->meter_id,
            'group_id' => $this->group_id,
        ]);

        return $dataProvider;
    }
}
