<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meter_summary".
 *
 * @property int $meter_id
 * @property string $report
 * @property string $start_timestamp
 * @property string $end_timestamp
 * @property double $kWh_Tot_Min
 * @property double $kWh_Tot_Max
 * @property double $kWh_Tot_Diff
 * @property double $kWh_Tariff_1_Min
 * @property double $kWh_Tariff_1_Max
 * @property double $kWh_Tariff_1_Diff
 * @property double $kWh_Tariff_2_Min
 * @property double $kWh_Tariff_2_Max
 * @property double $kWh_Tariff_2_Diff
 * @property double $kWh_Tariff_3_Min
 * @property double $kWh_Tariff_3_Max
 * @property double $kWh_Tariff_3_Diff
 * @property double $kWh_Tariff_4_Min
 * @property double $kWh_Tariff_4_Max
 * @property double $kWh_Tariff_4_Diff
 * @property double $RMS_Volts_Ln_1_Average
 * @property double $RMS_Volts_Ln_1_StdDev
 * @property double $RMS_Volts_Ln_1_Min
 * @property double $RMS_Volts_Ln_1_Max
 * @property double $RMS_Volts_Ln_2_Average
 * @property double $RMS_Volts_Ln_2_StdDev
 * @property double $RMS_Volts_Ln_2_Min
 * @property double $RMS_Volts_Ln_2_Max
 * @property double $RMS_Volts_Ln_3_Average
 * @property double $RMS_Volts_Ln_3_StdDev
 * @property double $RMS_Volts_Ln_3_Min
 * @property double $RMS_Volts_Ln_3_Max
 * @property double $Amps_Ln_1_Average
 * @property double $Amps_Ln_1_StdDev
 * @property double $Amps_Ln_1_Min
 * @property double $Amps_Ln_1_Max
 * @property double $Amps_Ln_2_Average
 * @property double $Amps_Ln_2_StdDev
 * @property double $Amps_Ln_2_Min
 * @property double $Amps_Ln_2_Max
 * @property double $Amps_Ln_3_Average
 * @property double $Amps_Ln_3_StdDev
 * @property double $Amps_Ln_3_Min
 * @property double $Amps_Ln_3_Max
 * @property double $RMS_Watts_Ln_1_Average
 * @property double $RMS_Watts_Ln_1_StdDev
 * @property double $RMS_Watts_Ln_1_Min
 * @property double $RMS_Watts_Ln_1_Max
 * @property double $RMS_Watts_Ln_2_Average
 * @property double $RMS_Watts_Ln_2_StdDev
 * @property double $RMS_Watts_Ln_2_Min
 * @property double $RMS_Watts_Ln_2_Max
 * @property double $RMS_Watts_Ln_3_Average
 * @property double $RMS_Watts_Ln_3_StdDev
 * @property double $RMS_Watts_Ln_3_Min
 * @property double $RMS_Watts_Ln_3_Max
 * @property string $start_date
 * @property string $end_date
 *
 * @property Meter $meter
 */
class MeterSummary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meter_summary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'report', 'start_timestamp', 'end_timestamp', 'kWh_Tot_Min', 'kWh_Tot_Max', 'kWh_Tot_Diff', 'kWh_Tariff_1_Min', 'kWh_Tariff_1_Max', 'kWh_Tariff_1_Diff', 'kWh_Tariff_2_Min', 'kWh_Tariff_2_Max', 'kWh_Tariff_2_Diff', 'kWh_Tariff_3_Min', 'kWh_Tariff_3_Max', 'kWh_Tariff_3_Diff', 'kWh_Tariff_4_Min', 'kWh_Tariff_4_Max', 'kWh_Tariff_4_Diff', 'RMS_Volts_Ln_1_Average', 'RMS_Volts_Ln_1_StdDev', 'RMS_Volts_Ln_1_Min', 'RMS_Volts_Ln_1_Max', 'RMS_Volts_Ln_2_Average', 'RMS_Volts_Ln_2_StdDev', 'RMS_Volts_Ln_2_Min', 'RMS_Volts_Ln_2_Max', 'RMS_Volts_Ln_3_Average', 'RMS_Volts_Ln_3_StdDev', 'RMS_Volts_Ln_3_Min', 'RMS_Volts_Ln_3_Max', 'Amps_Ln_1_Average', 'Amps_Ln_1_StdDev', 'Amps_Ln_1_Min', 'Amps_Ln_1_Max', 'Amps_Ln_2_Average', 'Amps_Ln_2_StdDev', 'Amps_Ln_2_Min', 'Amps_Ln_2_Max', 'Amps_Ln_3_Average', 'Amps_Ln_3_StdDev', 'Amps_Ln_3_Min', 'Amps_Ln_3_Max', 'RMS_Watts_Ln_1_Average', 'RMS_Watts_Ln_1_StdDev', 'RMS_Watts_Ln_1_Min', 'RMS_Watts_Ln_1_Max', 'RMS_Watts_Ln_2_Average', 'RMS_Watts_Ln_2_StdDev', 'RMS_Watts_Ln_2_Min', 'RMS_Watts_Ln_2_Max', 'RMS_Watts_Ln_3_Average', 'RMS_Watts_Ln_3_StdDev', 'RMS_Watts_Ln_3_Min', 'RMS_Watts_Ln_3_Max'], 'required'],
            [['meter_id', 'start_timestamp', 'end_timestamp'], 'integer'],
            [['kWh_Tot_Min', 'kWh_Tot_Max', 'kWh_Tot_Diff', 'kWh_Tariff_1_Min', 'kWh_Tariff_1_Max', 'kWh_Tariff_1_Diff', 'kWh_Tariff_2_Min', 'kWh_Tariff_2_Max', 'kWh_Tariff_2_Diff', 'kWh_Tariff_3_Min', 'kWh_Tariff_3_Max', 'kWh_Tariff_3_Diff', 'kWh_Tariff_4_Min', 'kWh_Tariff_4_Max', 'kWh_Tariff_4_Diff', 'RMS_Volts_Ln_1_Average', 'RMS_Volts_Ln_1_StdDev', 'RMS_Volts_Ln_1_Min', 'RMS_Volts_Ln_1_Max', 'RMS_Volts_Ln_2_Average', 'RMS_Volts_Ln_2_StdDev', 'RMS_Volts_Ln_2_Min', 'RMS_Volts_Ln_2_Max', 'RMS_Volts_Ln_3_Average', 'RMS_Volts_Ln_3_StdDev', 'RMS_Volts_Ln_3_Min', 'RMS_Volts_Ln_3_Max', 'Amps_Ln_1_Average', 'Amps_Ln_1_StdDev', 'Amps_Ln_1_Min', 'Amps_Ln_1_Max', 'Amps_Ln_2_Average', 'Amps_Ln_2_StdDev', 'Amps_Ln_2_Min', 'Amps_Ln_2_Max', 'Amps_Ln_3_Average', 'Amps_Ln_3_StdDev', 'Amps_Ln_3_Min', 'Amps_Ln_3_Max', 'RMS_Watts_Ln_1_Average', 'RMS_Watts_Ln_1_StdDev', 'RMS_Watts_Ln_1_Min', 'RMS_Watts_Ln_1_Max', 'RMS_Watts_Ln_2_Average', 'RMS_Watts_Ln_2_StdDev', 'RMS_Watts_Ln_2_Min', 'RMS_Watts_Ln_2_Max', 'RMS_Watts_Ln_3_Average', 'RMS_Watts_Ln_3_StdDev', 'RMS_Watts_Ln_3_Min', 'RMS_Watts_Ln_3_Max'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['report'], 'string', 'max' => 2],
            [['meter_id', 'report', 'start_timestamp'], 'unique', 'targetAttribute' => ['meter_id', 'report', 'start_timestamp']],
            [['meter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meter::className(), 'targetAttribute' => ['meter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meter_id' => 'Meter ID',
            'report' => 'Report',
            'start_timestamp' => 'Start Timestamp',
            'end_timestamp' => 'End Timestamp',
            'kWh_Tot_Min' => 'K Wh Tot Min',
            'kWh_Tot_Max' => 'K Wh Tot Max',
            'kWh_Tot_Diff' => 'K Wh Tot Diff',
            'kWh_Tariff_1_Min' => 'K Wh Tariff 1 Min',
            'kWh_Tariff_1_Max' => 'K Wh Tariff 1 Max',
            'kWh_Tariff_1_Diff' => 'K Wh Tariff 1 Diff',
            'kWh_Tariff_2_Min' => 'K Wh Tariff 2 Min',
            'kWh_Tariff_2_Max' => 'K Wh Tariff 2 Max',
            'kWh_Tariff_2_Diff' => 'K Wh Tariff 2 Diff',
            'kWh_Tariff_3_Min' => 'K Wh Tariff 3 Min',
            'kWh_Tariff_3_Max' => 'K Wh Tariff 3 Max',
            'kWh_Tariff_3_Diff' => 'K Wh Tariff 3 Diff',
            'kWh_Tariff_4_Min' => 'K Wh Tariff 4 Min',
            'kWh_Tariff_4_Max' => 'K Wh Tariff 4 Max',
            'kWh_Tariff_4_Diff' => 'K Wh Tariff 4 Diff',
            'RMS_Volts_Ln_1_Average' => 'Rms Volts Ln 1 Average',
            'RMS_Volts_Ln_1_StdDev' => 'Rms Volts Ln 1 Std Dev',
            'RMS_Volts_Ln_1_Min' => 'Rms Volts Ln 1 Min',
            'RMS_Volts_Ln_1_Max' => 'Rms Volts Ln 1 Max',
            'RMS_Volts_Ln_2_Average' => 'Rms Volts Ln 2 Average',
            'RMS_Volts_Ln_2_StdDev' => 'Rms Volts Ln 2 Std Dev',
            'RMS_Volts_Ln_2_Min' => 'Rms Volts Ln 2 Min',
            'RMS_Volts_Ln_2_Max' => 'Rms Volts Ln 2 Max',
            'RMS_Volts_Ln_3_Average' => 'Rms Volts Ln 3 Average',
            'RMS_Volts_Ln_3_StdDev' => 'Rms Volts Ln 3 Std Dev',
            'RMS_Volts_Ln_3_Min' => 'Rms Volts Ln 3 Min',
            'RMS_Volts_Ln_3_Max' => 'Rms Volts Ln 3 Max',
            'Amps_Ln_1_Average' => 'Amps Ln 1 Average',
            'Amps_Ln_1_StdDev' => 'Amps Ln 1 Std Dev',
            'Amps_Ln_1_Min' => 'Amps Ln 1 Min',
            'Amps_Ln_1_Max' => 'Amps Ln 1 Max',
            'Amps_Ln_2_Average' => 'Amps Ln 2 Average',
            'Amps_Ln_2_StdDev' => 'Amps Ln 2 Std Dev',
            'Amps_Ln_2_Min' => 'Amps Ln 2 Min',
            'Amps_Ln_2_Max' => 'Amps Ln 2 Max',
            'Amps_Ln_3_Average' => 'Amps Ln 3 Average',
            'Amps_Ln_3_StdDev' => 'Amps Ln 3 Std Dev',
            'Amps_Ln_3_Min' => 'Amps Ln 3 Min',
            'Amps_Ln_3_Max' => 'Amps Ln 3 Max',
            'RMS_Watts_Ln_1_Average' => 'Rms Watts Ln 1 Average',
            'RMS_Watts_Ln_1_StdDev' => 'Rms Watts Ln 1 Std Dev',
            'RMS_Watts_Ln_1_Min' => 'Rms Watts Ln 1 Min',
            'RMS_Watts_Ln_1_Max' => 'Rms Watts Ln 1 Max',
            'RMS_Watts_Ln_2_Average' => 'Rms Watts Ln 2 Average',
            'RMS_Watts_Ln_2_StdDev' => 'Rms Watts Ln 2 Std Dev',
            'RMS_Watts_Ln_2_Min' => 'Rms Watts Ln 2 Min',
            'RMS_Watts_Ln_2_Max' => 'Rms Watts Ln 2 Max',
            'RMS_Watts_Ln_3_Average' => 'Rms Watts Ln 3 Average',
            'RMS_Watts_Ln_3_StdDev' => 'Rms Watts Ln 3 Std Dev',
            'RMS_Watts_Ln_3_Min' => 'Rms Watts Ln 3 Min',
            'RMS_Watts_Ln_3_Max' => 'Rms Watts Ln 3 Max',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeter()
    {
        return $this->hasOne(Meter::className(), ['id' => 'meter_id']);
    }
}
