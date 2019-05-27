<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MeterSummary;

/**
 * MeterSummarySearch represents the model behind the search form of `app\models\MeterSummary`.
 */
class MeterSummarySearch extends MeterSummary
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'start_timestamp', 'end_timestamp'], 'integer'],
            [['report', 'start_date', 'end_date'], 'safe'],
            [['kWh_Tot_Min', 'kWh_Tot_Max', 'kWh_Tot_Diff', 'kWh_Tariff_1_Min', 'kWh_Tariff_1_Max', 'kWh_Tariff_1_Diff', 'kWh_Tariff_2_Min', 'kWh_Tariff_2_Max', 'kWh_Tariff_2_Diff', 'kWh_Tariff_3_Min', 'kWh_Tariff_3_Max', 'kWh_Tariff_3_Diff', 'kWh_Tariff_4_Min', 'kWh_Tariff_4_Max', 'kWh_Tariff_4_Diff', 'RMS_Volts_Ln_1_Average', 'RMS_Volts_Ln_1_StdDev', 'RMS_Volts_Ln_1_Min', 'RMS_Volts_Ln_1_Max', 'RMS_Volts_Ln_2_Average', 'RMS_Volts_Ln_2_StdDev', 'RMS_Volts_Ln_2_Min', 'RMS_Volts_Ln_2_Max', 'RMS_Volts_Ln_3_Average', 'RMS_Volts_Ln_3_StdDev', 'RMS_Volts_Ln_3_Min', 'RMS_Volts_Ln_3_Max', 'Amps_Ln_1_Average', 'Amps_Ln_1_StdDev', 'Amps_Ln_1_Min', 'Amps_Ln_1_Max', 'Amps_Ln_2_Average', 'Amps_Ln_2_StdDev', 'Amps_Ln_2_Min', 'Amps_Ln_2_Max', 'Amps_Ln_3_Average', 'Amps_Ln_3_StdDev', 'Amps_Ln_3_Min', 'Amps_Ln_3_Max', 'RMS_Watts_Ln_1_Average', 'RMS_Watts_Ln_1_StdDev', 'RMS_Watts_Ln_1_Min', 'RMS_Watts_Ln_1_Max', 'RMS_Watts_Ln_2_Average', 'RMS_Watts_Ln_2_StdDev', 'RMS_Watts_Ln_2_Min', 'RMS_Watts_Ln_2_Max', 'RMS_Watts_Ln_3_Average', 'RMS_Watts_Ln_3_StdDev', 'RMS_Watts_Ln_3_Min', 'RMS_Watts_Ln_3_Max'], 'number'],
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
        $query = MeterSummary::find();

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
            'start_timestamp' => $this->start_timestamp,
            'end_timestamp' => $this->end_timestamp,
            'kWh_Tot_Min' => $this->kWh_Tot_Min,
            'kWh_Tot_Max' => $this->kWh_Tot_Max,
            'kWh_Tot_Diff' => $this->kWh_Tot_Diff,
            'kWh_Tariff_1_Min' => $this->kWh_Tariff_1_Min,
            'kWh_Tariff_1_Max' => $this->kWh_Tariff_1_Max,
            'kWh_Tariff_1_Diff' => $this->kWh_Tariff_1_Diff,
            'kWh_Tariff_2_Min' => $this->kWh_Tariff_2_Min,
            'kWh_Tariff_2_Max' => $this->kWh_Tariff_2_Max,
            'kWh_Tariff_2_Diff' => $this->kWh_Tariff_2_Diff,
            'kWh_Tariff_3_Min' => $this->kWh_Tariff_3_Min,
            'kWh_Tariff_3_Max' => $this->kWh_Tariff_3_Max,
            'kWh_Tariff_3_Diff' => $this->kWh_Tariff_3_Diff,
            'kWh_Tariff_4_Min' => $this->kWh_Tariff_4_Min,
            'kWh_Tariff_4_Max' => $this->kWh_Tariff_4_Max,
            'kWh_Tariff_4_Diff' => $this->kWh_Tariff_4_Diff,
            'RMS_Volts_Ln_1_Average' => $this->RMS_Volts_Ln_1_Average,
            'RMS_Volts_Ln_1_StdDev' => $this->RMS_Volts_Ln_1_StdDev,
            'RMS_Volts_Ln_1_Min' => $this->RMS_Volts_Ln_1_Min,
            'RMS_Volts_Ln_1_Max' => $this->RMS_Volts_Ln_1_Max,
            'RMS_Volts_Ln_2_Average' => $this->RMS_Volts_Ln_2_Average,
            'RMS_Volts_Ln_2_StdDev' => $this->RMS_Volts_Ln_2_StdDev,
            'RMS_Volts_Ln_2_Min' => $this->RMS_Volts_Ln_2_Min,
            'RMS_Volts_Ln_2_Max' => $this->RMS_Volts_Ln_2_Max,
            'RMS_Volts_Ln_3_Average' => $this->RMS_Volts_Ln_3_Average,
            'RMS_Volts_Ln_3_StdDev' => $this->RMS_Volts_Ln_3_StdDev,
            'RMS_Volts_Ln_3_Min' => $this->RMS_Volts_Ln_3_Min,
            'RMS_Volts_Ln_3_Max' => $this->RMS_Volts_Ln_3_Max,
            'Amps_Ln_1_Average' => $this->Amps_Ln_1_Average,
            'Amps_Ln_1_StdDev' => $this->Amps_Ln_1_StdDev,
            'Amps_Ln_1_Min' => $this->Amps_Ln_1_Min,
            'Amps_Ln_1_Max' => $this->Amps_Ln_1_Max,
            'Amps_Ln_2_Average' => $this->Amps_Ln_2_Average,
            'Amps_Ln_2_StdDev' => $this->Amps_Ln_2_StdDev,
            'Amps_Ln_2_Min' => $this->Amps_Ln_2_Min,
            'Amps_Ln_2_Max' => $this->Amps_Ln_2_Max,
            'Amps_Ln_3_Average' => $this->Amps_Ln_3_Average,
            'Amps_Ln_3_StdDev' => $this->Amps_Ln_3_StdDev,
            'Amps_Ln_3_Min' => $this->Amps_Ln_3_Min,
            'Amps_Ln_3_Max' => $this->Amps_Ln_3_Max,
            'RMS_Watts_Ln_1_Average' => $this->RMS_Watts_Ln_1_Average,
            'RMS_Watts_Ln_1_StdDev' => $this->RMS_Watts_Ln_1_StdDev,
            'RMS_Watts_Ln_1_Min' => $this->RMS_Watts_Ln_1_Min,
            'RMS_Watts_Ln_1_Max' => $this->RMS_Watts_Ln_1_Max,
            'RMS_Watts_Ln_2_Average' => $this->RMS_Watts_Ln_2_Average,
            'RMS_Watts_Ln_2_StdDev' => $this->RMS_Watts_Ln_2_StdDev,
            'RMS_Watts_Ln_2_Min' => $this->RMS_Watts_Ln_2_Min,
            'RMS_Watts_Ln_2_Max' => $this->RMS_Watts_Ln_2_Max,
            'RMS_Watts_Ln_3_Average' => $this->RMS_Watts_Ln_3_Average,
            'RMS_Watts_Ln_3_StdDev' => $this->RMS_Watts_Ln_3_StdDev,
            'RMS_Watts_Ln_3_Min' => $this->RMS_Watts_Ln_3_Min,
            'RMS_Watts_Ln_3_Max' => $this->RMS_Watts_Ln_3_Max,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'report', $this->report]);

        return $dataProvider;
    }
}
