<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeterDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meter-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'meter_id') ?>

    <?= $form->field($model, 'timestamp') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'day') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'hour') ?>

    <?php // echo $form->field($model, 'minute') ?>

    <?php // echo $form->field($model, 'weekday') ?>

    <?php // echo $form->field($model, 'week') ?>

    <?php // echo $form->field($model, 'apiversion') ?>

    <?php // echo $form->field($model, 'kWh_Tot') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_1') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_2') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_1') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_2') ?>

    <?php // echo $form->field($model, 'Rev_kWh_Tot') ?>

    <?php // echo $form->field($model, 'Rev_kWh_Tariff_1') ?>

    <?php // echo $form->field($model, 'Rev_kWh_Tariff_2') ?>

    <?php // echo $form->field($model, 'Power_Factor_Ln_1') ?>

    <?php // echo $form->field($model, 'Power_Factor_Ln_2') ?>

    <?php // echo $form->field($model, 'Power_Factor_Ln_3') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Max_Demand') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Tot') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_1') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_2') ?>

    <?php // echo $form->field($model, 'Amps_Ln_1') ?>

    <?php // echo $form->field($model, 'Amps_Ln_2') ?>

    <?php // echo $form->field($model, 'Max_Demand_Period') ?>

    <?php // echo $form->field($model, 'CT_Ratio') ?>

    <?php // echo $form->field($model, 'Meter_Status_Code') ?>

    <?php // echo $form->field($model, 'timezone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
