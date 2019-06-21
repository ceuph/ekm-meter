<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\EkmSummaryApi;
use app\models\Meter;
use app\models\MeterSummary;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class EkmController extends Controller
{
    public $endDate;
    public $limit = 10;
    public $loop = true;
    public $type = EkmSummaryApi::REPORT_DAY;

    public function options($actionID)
    {
        return ['endDate', 'limit', 'loop', 'type'];
    }

    public function actionIndex()
    {
        echo 'test';
        return ExitCode::OK;
    }

    public function actionSummaryUpdate()
    {
        $reports = [
            EkmSummaryApi::REPORT_HOUR,
            EkmSummaryApi::REPORT_DAY,
            EkmSummaryApi::REPORT_WEEK,
            EkmSummaryApi::REPORT_MONTH
        ];
        if (false === in_array($this->type, $reports)) {
            echo 'Invalid Type Specified. Valid types are "' . implode('", "', $reports) . '".';
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $meters = Meter::find()->all();
        foreach ($meters as $meter) {
            $prev = '';
            $endDate = $this->endDate;
            $max = MeterSummary::find()
                ->where(['meter_id' => $meter->id, 'report' => $this->type])
                ->max('end_timestamp');

            $loop = true;
            if (false === $this->loop) {
                $loop = false;
            }
            do {
                \Yii::$app->ekmSummary->setLimit($this->limit);
                \Yii::$app->ekmSummary->setReport($this->type);
                \Yii::$app->ekmSummary->setMeters($meter->id);
                \Yii::$app->ekmSummary->setEndDate(new \DateTime($endDate));
                echo \Yii::$app->ekmSummary->getUrl() . "\n";

                $summaries = \Yii::$app->ekmSummary->getData();
                foreach ($summaries as $summary) {
                    $this->saveSummary($meter->id, $this->type, $summary);
                    $endDate = '@' . substr($summary->End_Time_Stamp_UTC_ms, 0, strlen($summary->End_Time_Stamp_UTC_ms) - 3);
                }

                if (count($summaries) < $this->limit || $prev == $endDate) {
                    $loop = false;
                } elseif($max >= substr($summary->End_Time_Stamp_UTC_ms, 0, strlen($summary->End_Time_Stamp_UTC_ms) - 3)) {
                    $loop = false;
                } else {
                    $prev = $endDate;
                }
            } while ($loop);
        }
    }

    protected function saveSummary($id, $report, $summary)
    {
        $meterSummary = MeterSummary::findOne([
            'meter_id' => $id,
            'report' => $report,
            'start_timestamp' => substr($summary->Start_Time_Stamp_UTC_ms, 0, strlen($summary->Start_Time_Stamp_UTC_ms) - 3)
        ]);
        if (null === $meterSummary) {
            $meterSummary = new MeterSummary();
        }
        $meterSummary->meter_id = $id;
        $meterSummary->report = $report;
        $meterSummary->start_timestamp = substr($summary->Start_Time_Stamp_UTC_ms, 0, strlen($summary->Start_Time_Stamp_UTC_ms) - 3);
        $meterSummary->end_timestamp = substr($summary->End_Time_Stamp_UTC_ms, 0, strlen($summary->End_Time_Stamp_UTC_ms) - 3);
        $meterSummary->year = date('Y', $meterSummary->start_timestamp);
        $meterSummary->month = date('n',$meterSummary->start_timestamp);
        $meterSummary->day = date('j', $meterSummary->start_timestamp);
        $meterSummary->hour = date('G', $meterSummary->start_timestamp);
        $meterSummary->kWh_Tot_Min = $summary->kWh_Tot_Min;
        $meterSummary->kWh_Tot_Max = $summary->kWh_Tot_Max;
        $meterSummary->kWh_Tot_Diff = $summary->kWh_Tot_Diff;
        $meterSummary->kWh_Tariff_1_Min = $summary->kWh_Tariff_1_Min;
        $meterSummary->kWh_Tariff_1_Max = $summary->kWh_Tariff_1_Max;
        $meterSummary->kWh_Tariff_1_Diff = $summary->kWh_Tariff_1_Diff;
        $meterSummary->kWh_Tariff_2_Min = $summary->kWh_Tariff_2_Min;
        $meterSummary->kWh_Tariff_2_Max = $summary->kWh_Tariff_2_Max;
        $meterSummary->kWh_Tariff_2_Diff = $summary->kWh_Tariff_2_Diff;
        $meterSummary->kWh_Tariff_3_Min = $summary->kWh_Tariff_3_Min;
        $meterSummary->kWh_Tariff_3_Max = $summary->kWh_Tariff_3_Max;
        $meterSummary->kWh_Tariff_3_Diff = $summary->kWh_Tariff_3_Diff;
        $meterSummary->kWh_Tariff_4_Min = $summary->kWh_Tariff_4_Min;
        $meterSummary->kWh_Tariff_4_Max = $summary->kWh_Tariff_4_Max;
        $meterSummary->kWh_Tariff_4_Diff = $summary->kWh_Tariff_4_Diff;
        $meterSummary->RMS_Volts_Ln_1_Average = $summary->RMS_Volts_Ln_1_Average;
        $meterSummary->RMS_Volts_Ln_1_StdDev = $summary->RMS_Volts_Ln_1_StdDev;
        $meterSummary->RMS_Volts_Ln_1_Min = $summary->RMS_Volts_Ln_1_Min;
        $meterSummary->RMS_Volts_Ln_1_Max = $summary->RMS_Volts_Ln_1_Max;
        $meterSummary->RMS_Volts_Ln_2_Average = $summary->RMS_Volts_Ln_2_Average;
        $meterSummary->RMS_Volts_Ln_2_StdDev = $summary->RMS_Volts_Ln_2_StdDev;
        $meterSummary->RMS_Volts_Ln_2_Min = $summary->RMS_Volts_Ln_2_Min;
        $meterSummary->RMS_Volts_Ln_2_Max = $summary->RMS_Volts_Ln_2_Max;
        $meterSummary->RMS_Volts_Ln_3_Average = $summary->RMS_Volts_Ln_3_Average;
        $meterSummary->RMS_Volts_Ln_3_StdDev = $summary->RMS_Volts_Ln_3_StdDev;
        $meterSummary->RMS_Volts_Ln_3_Min = $summary->RMS_Volts_Ln_3_Min;
        $meterSummary->RMS_Volts_Ln_3_Max = $summary->RMS_Volts_Ln_3_Max;
        $meterSummary->Amps_Ln_1_Average = $summary->Amps_Ln_1_Average;
        $meterSummary->Amps_Ln_1_StdDev = $summary->Amps_Ln_1_StdDev;
        $meterSummary->Amps_Ln_1_Min = $summary->Amps_Ln_1_Min;
        $meterSummary->Amps_Ln_1_Max = $summary->Amps_Ln_1_Max;
        $meterSummary->Amps_Ln_2_Average = $summary->Amps_Ln_2_Average;
        $meterSummary->Amps_Ln_2_StdDev = $summary->Amps_Ln_2_StdDev;
        $meterSummary->Amps_Ln_2_Min = $summary->Amps_Ln_2_Min;
        $meterSummary->Amps_Ln_2_Max = $summary->Amps_Ln_2_Max;
        $meterSummary->Amps_Ln_3_Average = $summary->Amps_Ln_3_Average;
        $meterSummary->Amps_Ln_3_StdDev = $summary->Amps_Ln_3_StdDev;
        $meterSummary->Amps_Ln_3_Min = $summary->Amps_Ln_3_Min;
        $meterSummary->Amps_Ln_3_Max = $summary->Amps_Ln_3_Max;
        $meterSummary->RMS_Watts_Ln_1_Average = $summary->RMS_Watts_Ln_1_Average;
        $meterSummary->RMS_Watts_Ln_1_StdDev = $summary->RMS_Watts_Ln_1_StdDev;
        $meterSummary->RMS_Watts_Ln_1_Min = $summary->RMS_Watts_Ln_1_Min;
        $meterSummary->RMS_Watts_Ln_1_Max = $summary->RMS_Watts_Ln_1_Max;
        $meterSummary->RMS_Watts_Ln_2_Average = $summary->RMS_Watts_Ln_2_Average;
        $meterSummary->RMS_Watts_Ln_2_StdDev = $summary->RMS_Watts_Ln_2_StdDev;
        $meterSummary->RMS_Watts_Ln_2_Min = $summary->RMS_Watts_Ln_2_Min;
        $meterSummary->RMS_Watts_Ln_2_Max = $summary->RMS_Watts_Ln_2_Max;
        $meterSummary->RMS_Watts_Ln_3_Average = $summary->RMS_Watts_Ln_3_Average;
        $meterSummary->RMS_Watts_Ln_3_StdDev = $summary->RMS_Watts_Ln_3_StdDev;
        $meterSummary->RMS_Watts_Ln_3_Min = $summary->RMS_Watts_Ln_3_Min;
        $meterSummary->RMS_Watts_Ln_3_Max = $summary->RMS_Watts_Ln_3_Max;
        $meterSummary->save();
    }
}