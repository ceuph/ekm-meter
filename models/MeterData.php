<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meter_data".
 *
 * @property int $meter_id
 * @property string $timestamp
 * @property int $month
 * @property int $day
 * @property int $year
 * @property int $hour
 * @property int $minute
 * @property string $weekday MON-SUN
 * @property int $week 1-4 indicates 1st week, 2nd week, etc
 * @property string $apiversion
 * @property double $kWh_Tot
 * @property double $kWh_Tariff_1
 * @property double $kWh_Tariff_2
 * @property double $RMS_Volts_Ln_1
 * @property double $RMS_Volts_Ln_2
 * @property double $Rev_kWh_Tot
 * @property double $Rev_kWh_Tariff_1
 * @property double $Rev_kWh_Tariff_2
 * @property double $Power_Factor_Ln_1
 * @property double $Power_Factor_Ln_2
 * @property double $Power_Factor_Ln_3
 * @property double $RMS_Watts_Max_Demand
 * @property double $RMS_Watts_Tot
 * @property double $RMS_Watts_Ln_1
 * @property double $RMS_Watts_Ln_2
 * @property double $Amps_Ln_1
 * @property double $Amps_Ln_2
 * @property double $Max_Demand_Period
 * @property double $CT_Ratio
 * @property double $Meter_Status_Code
 * @property string $timezone
 *
 * @property Meter $meter
 */
class MeterData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meter_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meter_id', 'timestamp', 'month', 'day', 'year', 'hour', 'minute', 'weekday', 'week', 'apiversion', 'kWh_Tot', 'kWh_Tariff_1', 'kWh_Tariff_2', 'RMS_Volts_Ln_1', 'RMS_Volts_Ln_2', 'Rev_kWh_Tot', 'Rev_kWh_Tariff_1', 'Rev_kWh_Tariff_2', 'Power_Factor_Ln_1', 'Power_Factor_Ln_2', 'Power_Factor_Ln_3', 'RMS_Watts_Max_Demand', 'RMS_Watts_Tot', 'RMS_Watts_Ln_1', 'RMS_Watts_Ln_2', 'Amps_Ln_1', 'Amps_Ln_2', 'Max_Demand_Period', 'CT_Ratio', 'Meter_Status_Code', 'timezone'], 'required'],
            [['meter_id', 'timestamp', 'month', 'day', 'year', 'hour', 'minute', 'week'], 'integer'],
            [['kWh_Tot', 'kWh_Tariff_1', 'kWh_Tariff_2', 'RMS_Volts_Ln_1', 'RMS_Volts_Ln_2', 'Rev_kWh_Tot', 'Rev_kWh_Tariff_1', 'Rev_kWh_Tariff_2', 'Power_Factor_Ln_1', 'Power_Factor_Ln_2', 'Power_Factor_Ln_3', 'RMS_Watts_Max_Demand', 'RMS_Watts_Tot', 'RMS_Watts_Ln_1', 'RMS_Watts_Ln_2', 'Amps_Ln_1', 'Amps_Ln_2', 'Max_Demand_Period', 'CT_Ratio', 'Meter_Status_Code'], 'number'],
            [['weekday'], 'string', 'max' => 3],
            [['apiversion'], 'string', 'max' => 5],
            [['timezone'], 'string', 'max' => 20],
            [['meter_id', 'timestamp'], 'unique', 'targetAttribute' => ['meter_id', 'timestamp']],
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
            'timestamp' => 'Timestamp',
            'month' => 'Month',
            'day' => 'Day',
            'year' => 'Year',
            'hour' => 'Hour',
            'minute' => 'Minute',
            'weekday' => 'Weekday',
            'week' => 'Week',
            'apiversion' => 'Apiversion',
            'kWh_Tot' => 'K Wh Tot',
            'kWh_Tariff_1' => 'K Wh Tariff 1',
            'kWh_Tariff_2' => 'K Wh Tariff 2',
            'RMS_Volts_Ln_1' => 'Rms Volts Ln 1',
            'RMS_Volts_Ln_2' => 'Rms Volts Ln 2',
            'Rev_kWh_Tot' => 'Rev K Wh Tot',
            'Rev_kWh_Tariff_1' => 'Rev K Wh Tariff 1',
            'Rev_kWh_Tariff_2' => 'Rev K Wh Tariff 2',
            'Power_Factor_Ln_1' => 'Power Factor Ln 1',
            'Power_Factor_Ln_2' => 'Power Factor Ln 2',
            'Power_Factor_Ln_3' => 'Power Factor Ln 3',
            'RMS_Watts_Max_Demand' => 'Rms Watts Max Demand',
            'RMS_Watts_Tot' => 'Rms Watts Tot',
            'RMS_Watts_Ln_1' => 'Rms Watts Ln 1',
            'RMS_Watts_Ln_2' => 'Rms Watts Ln 2',
            'Amps_Ln_1' => 'Amps Ln 1',
            'Amps_Ln_2' => 'Amps Ln 2',
            'Max_Demand_Period' => 'Max Demand Period',
            'CT_Ratio' => 'Ct Ratio',
            'Meter_Status_Code' => 'Meter Status Code',
            'timezone' => 'Timezone',
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
