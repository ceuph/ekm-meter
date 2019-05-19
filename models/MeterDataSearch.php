<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeterData;

/**
 * MeterDataSearch represents the model behind the search form of `app\models\MeterData`.
 */
class MeterDataSearch extends MeterData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'timestamp', 'month', 'day', 'year', 'hour', 'minute', 'week'], 'integer'],
            [['weekday', 'apiversion', 'timezone'], 'safe'],
            [['kWh_Tot', 'kWh_Tariff_1', 'kWh_Tariff_2', 'RMS_Volts_Ln_1', 'RMS_Volts_Ln_2', 'Rev_kWh_Tot', 'Rev_kWh_Tariff_1', 'Rev_kWh_Tariff_2', 'Power_Factor_Ln_1', 'Power_Factor_Ln_2', 'Power_Factor_Ln_3', 'RMS_Watts_Max_Demand', 'RMS_Watts_Tot', 'RMS_Watts_Ln_1', 'RMS_Watts_Ln_2', 'Amps_Ln_1', 'Amps_Ln_2', 'Max_Demand_Period', 'CT_Ratio', 'Meter_Status_Code'], 'number'],
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
        $query = MeterData::find();

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
            'timestamp' => $this->timestamp,
            'month' => $this->month,
            'day' => $this->day,
            'year' => $this->year,
            'hour' => $this->hour,
            'minute' => $this->minute,
            'week' => $this->week,
            'kWh_Tot' => $this->kWh_Tot,
            'kWh_Tariff_1' => $this->kWh_Tariff_1,
            'kWh_Tariff_2' => $this->kWh_Tariff_2,
            'RMS_Volts_Ln_1' => $this->RMS_Volts_Ln_1,
            'RMS_Volts_Ln_2' => $this->RMS_Volts_Ln_2,
            'Rev_kWh_Tot' => $this->Rev_kWh_Tot,
            'Rev_kWh_Tariff_1' => $this->Rev_kWh_Tariff_1,
            'Rev_kWh_Tariff_2' => $this->Rev_kWh_Tariff_2,
            'Power_Factor_Ln_1' => $this->Power_Factor_Ln_1,
            'Power_Factor_Ln_2' => $this->Power_Factor_Ln_2,
            'Power_Factor_Ln_3' => $this->Power_Factor_Ln_3,
            'RMS_Watts_Max_Demand' => $this->RMS_Watts_Max_Demand,
            'RMS_Watts_Tot' => $this->RMS_Watts_Tot,
            'RMS_Watts_Ln_1' => $this->RMS_Watts_Ln_1,
            'RMS_Watts_Ln_2' => $this->RMS_Watts_Ln_2,
            'Amps_Ln_1' => $this->Amps_Ln_1,
            'Amps_Ln_2' => $this->Amps_Ln_2,
            'Max_Demand_Period' => $this->Max_Demand_Period,
            'CT_Ratio' => $this->CT_Ratio,
            'Meter_Status_Code' => $this->Meter_Status_Code,
        ]);

        $query->andFilterWhere(['like', 'weekday', $this->weekday])
            ->andFilterWhere(['like', 'apiversion', $this->apiversion])
            ->andFilterWhere(['like', 'timezone', $this->timezone]);

        return $dataProvider;
    }
}
