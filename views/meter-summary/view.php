<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeterSummary */

$this->title = $model->meter_id;
$this->params['breadcrumbs'][] = ['label' => 'Meter Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meter-summary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'meter_id' => $model->meter_id, 'report' => $model->report, 'start_timestamp' => $model->start_timestamp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'meter_id' => $model->meter_id, 'report' => $model->report, 'start_timestamp' => $model->start_timestamp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'meter_id',
            'report',
            'start_timestamp',
            'end_timestamp',
            'kWh_Tot_Min',
            'kWh_Tot_Max',
            'kWh_Tot_Diff',
            'kWh_Tariff_1_Min',
            'kWh_Tariff_1_Max',
            'kWh_Tariff_1_Diff',
            'kWh_Tariff_2_Min',
            'kWh_Tariff_2_Max',
            'kWh_Tariff_2_Diff',
            'kWh_Tariff_3_Min',
            'kWh_Tariff_3_Max',
            'kWh_Tariff_3_Diff',
            'kWh_Tariff_4_Min',
            'kWh_Tariff_4_Max',
            'kWh_Tariff_4_Diff',
            'RMS_Volts_Ln_1_Average',
            'RMS_Volts_Ln_1_StdDev',
            'RMS_Volts_Ln_1_Min',
            'RMS_Volts_Ln_1_Max',
            'RMS_Volts_Ln_2_Average',
            'RMS_Volts_Ln_2_StdDev',
            'RMS_Volts_Ln_2_Min',
            'RMS_Volts_Ln_2_Max',
            'RMS_Volts_Ln_3_Average',
            'RMS_Volts_Ln_3_StdDev',
            'RMS_Volts_Ln_3_Min',
            'RMS_Volts_Ln_3_Max',
            'Amps_Ln_1_Average',
            'Amps_Ln_1_StdDev',
            'Amps_Ln_1_Min',
            'Amps_Ln_1_Max',
            'Amps_Ln_2_Average',
            'Amps_Ln_2_StdDev',
            'Amps_Ln_2_Min',
            'Amps_Ln_2_Max',
            'Amps_Ln_3_Average',
            'Amps_Ln_3_StdDev',
            'Amps_Ln_3_Min',
            'Amps_Ln_3_Max',
            'RMS_Watts_Ln_1_Average',
            'RMS_Watts_Ln_1_StdDev',
            'RMS_Watts_Ln_1_Min',
            'RMS_Watts_Ln_1_Max',
            'RMS_Watts_Ln_2_Average',
            'RMS_Watts_Ln_2_StdDev',
            'RMS_Watts_Ln_2_Min',
            'RMS_Watts_Ln_2_Max',
            'RMS_Watts_Ln_3_Average',
            'RMS_Watts_Ln_3_StdDev',
            'RMS_Watts_Ln_3_Min',
            'RMS_Watts_Ln_3_Max',
            'start_date',
            'end_date',
        ],
    ]) ?>

</div>
