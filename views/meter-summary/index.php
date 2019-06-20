<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeterSummarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title_prefix string */

$this->title = $title_prefix . 'Meter Summaries';
$this->params['breadcrumbs'][] = ['label' => 'Meter', 'url' => ['meter/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meter-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    try {
        echo DetailView::widget([
            'model' => $meter,
            'attributes' => [
                'id',
                'name',
                'description',
                [
                    'label' => 'Date Range',
                    'format' => 'html',
                    'value' => date('M d, Y h:i A', $queryParams['MeterSummarySearch']['min_start_timestamp']) . ' - ' . date('M d, Y h:i A', $queryParams['MeterSummarySearch']['max_start_timestamp'])
                ]
            ],
        ]);
    } catch (Exception $e) {
        echo '';
    }
    ?>
    <?php
    try {
        echo ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 100,
            ],
            'data' => [
                'labels' => $chartLabels,
                'datasets' => [
                    [
                        'label' => $chart_title,
                        'fill' => false,
                        'backgroundColor' => "rgba(179,181,198,0.2)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => $kwhTotDiffs
                    ]
                ]
            ]
        ]);
    } catch (Exception $e) {
        echo '';
    }
    ?>
    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                'start_timestamp:datetime',
                'end_timestamp:datetime',
                'kWh_Tot_Min',
                'kWh_Tot_Max',
                'kWh_Tot_Diff',
                //'kWh_Tariff_1_Min',
                //'kWh_Tariff_1_Max',
                //'kWh_Tariff_1_Diff',
                //'kWh_Tariff_2_Min',
                //'kWh_Tariff_2_Max',
                //'kWh_Tariff_2_Diff',
                //'kWh_Tariff_3_Min',
                //'kWh_Tariff_3_Max',
                //'kWh_Tariff_3_Diff',
                //'kWh_Tariff_4_Min',
                //'kWh_Tariff_4_Max',
                //'kWh_Tariff_4_Diff',
                //'RMS_Volts_Ln_1_Average',
                //'RMS_Volts_Ln_1_StdDev',
                //'RMS_Volts_Ln_1_Min',
                //'RMS_Volts_Ln_1_Max',
                //'RMS_Volts_Ln_2_Average',
                //'RMS_Volts_Ln_2_StdDev',
                //'RMS_Volts_Ln_2_Min',
                //'RMS_Volts_Ln_2_Max',
                //'RMS_Volts_Ln_3_Average',
                //'RMS_Volts_Ln_3_StdDev',
                //'RMS_Volts_Ln_3_Min',
                //'RMS_Volts_Ln_3_Max',
                //'Amps_Ln_1_Average',
                //'Amps_Ln_1_StdDev',
                //'Amps_Ln_1_Min',
                //'Amps_Ln_1_Max',
                //'Amps_Ln_2_Average',
                //'Amps_Ln_2_StdDev',
                //'Amps_Ln_2_Min',
                //'Amps_Ln_2_Max',
                //'Amps_Ln_3_Average',
                //'Amps_Ln_3_StdDev',
                //'Amps_Ln_3_Min',
                //'Amps_Ln_3_Max',
                //'RMS_Watts_Ln_1_Average',
                //'RMS_Watts_Ln_1_StdDev',
                //'RMS_Watts_Ln_1_Min',
                //'RMS_Watts_Ln_1_Max',
                //'RMS_Watts_Ln_2_Average',
                //'RMS_Watts_Ln_2_StdDev',
                //'RMS_Watts_Ln_2_Min',
                //'RMS_Watts_Ln_2_Max',
                //'RMS_Watts_Ln_3_Average',
                //'RMS_Watts_Ln_3_StdDev',
                //'RMS_Watts_Ln_3_Min',
                //'RMS_Watts_Ln_3_Max',
                //'start_date',
                //'end_date',
            ],
        ]);
    } catch (Exception $e) {
        echo 'An error occurred while retrieving meter summary.';
    }
    ?>
    <div class="row">
        <div class="col-lg-6">
            <?= Html::a('Previous (' . date('M d, Y h:i A', $prevParams['MeterSummarySearch']['min_start_timestamp']) . ' - ' . date('M d, Y h:i A', $prevParams['MeterSummarySearch']['max_start_timestamp']) . ')', ['meter-summary/index'] + $prevParams, ['class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-lg-6 col-sm-push-2">
            <?= Html::a('Next (' . date('M d, Y h:i A', $nextParams['MeterSummarySearch']['min_start_timestamp']) . ' - ' . date('M d, Y h:i A', $nextParams['MeterSummarySearch']['max_start_timestamp']) . ')', ['meter-summary/index'] + $nextParams, ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
</div>
