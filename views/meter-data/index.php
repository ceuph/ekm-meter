<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeterDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meter Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meter-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Meter Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'meter_id',
            'timestamp',
            'month',
            'day',
            'year',
            //'hour',
            //'minute',
            //'weekday',
            //'week',
            //'apiversion',
            //'kWh_Tot',
            //'kWh_Tariff_1',
            //'kWh_Tariff_2',
            //'RMS_Volts_Ln_1',
            //'RMS_Volts_Ln_2',
            //'Rev_kWh_Tot',
            //'Rev_kWh_Tariff_1',
            //'Rev_kWh_Tariff_2',
            //'Power_Factor_Ln_1',
            //'Power_Factor_Ln_2',
            //'Power_Factor_Ln_3',
            //'RMS_Watts_Max_Demand',
            //'RMS_Watts_Tot',
            //'RMS_Watts_Ln_1',
            //'RMS_Watts_Ln_2',
            //'Amps_Ln_1',
            //'Amps_Ln_2',
            //'Max_Demand_Period',
            //'CT_Ratio',
            //'Meter_Status_Code',
            //'timezone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
