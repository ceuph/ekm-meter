<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeterData */

$this->title = $model->meter_id;
$this->params['breadcrumbs'][] = ['label' => 'Meter Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meter-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'meter_id' => $model->meter_id, 'timestamp' => $model->timestamp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'meter_id' => $model->meter_id, 'timestamp' => $model->timestamp], [
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
            'timestamp',
            'month',
            'day',
            'year',
            'hour',
            'minute',
            'weekday',
            'week',
            'apiversion',
            'kWh_Tot',
            'kWh_Tariff_1',
            'kWh_Tariff_2',
            'RMS_Volts_Ln_1',
            'RMS_Volts_Ln_2',
            'Rev_kWh_Tot',
            'Rev_kWh_Tariff_1',
            'Rev_kWh_Tariff_2',
            'Power_Factor_Ln_1',
            'Power_Factor_Ln_2',
            'Power_Factor_Ln_3',
            'RMS_Watts_Max_Demand',
            'RMS_Watts_Tot',
            'RMS_Watts_Ln_1',
            'RMS_Watts_Ln_2',
            'Amps_Ln_1',
            'Amps_Ln_2',
            'Max_Demand_Period',
            'CT_Ratio',
            'Meter_Status_Code',
            'timezone',
        ],
    ]) ?>

</div>
