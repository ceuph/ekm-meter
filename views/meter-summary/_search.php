<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeterSummarySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meter-summary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'meter_id') ?>

    <?= $form->field($model, 'report') ?>

    <?= $form->field($model, 'start_timestamp') ?>

    <?= $form->field($model, 'end_timestamp') ?>

    <?= $form->field($model, 'kWh_Tot_Min') ?>

    <?php // echo $form->field($model, 'kWh_Tot_Max') ?>

    <?php // echo $form->field($model, 'kWh_Tot_Diff') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_1_Min') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_1_Max') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_1_Diff') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_2_Min') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_2_Max') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_2_Diff') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_3_Min') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_3_Max') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_3_Diff') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_4_Min') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_4_Max') ?>

    <?php // echo $form->field($model, 'kWh_Tariff_4_Diff') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_1_Average') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_1_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_1_Min') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_1_Max') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_2_Average') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_2_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_2_Min') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_2_Max') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_3_Average') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_3_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_3_Min') ?>

    <?php // echo $form->field($model, 'RMS_Volts_Ln_3_Max') ?>

    <?php // echo $form->field($model, 'Amps_Ln_1_Average') ?>

    <?php // echo $form->field($model, 'Amps_Ln_1_StdDev') ?>

    <?php // echo $form->field($model, 'Amps_Ln_1_Min') ?>

    <?php // echo $form->field($model, 'Amps_Ln_1_Max') ?>

    <?php // echo $form->field($model, 'Amps_Ln_2_Average') ?>

    <?php // echo $form->field($model, 'Amps_Ln_2_StdDev') ?>

    <?php // echo $form->field($model, 'Amps_Ln_2_Min') ?>

    <?php // echo $form->field($model, 'Amps_Ln_2_Max') ?>

    <?php // echo $form->field($model, 'Amps_Ln_3_Average') ?>

    <?php // echo $form->field($model, 'Amps_Ln_3_StdDev') ?>

    <?php // echo $form->field($model, 'Amps_Ln_3_Min') ?>

    <?php // echo $form->field($model, 'Amps_Ln_3_Max') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_1_Average') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_1_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_1_Min') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_1_Max') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_2_Average') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_2_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_2_Min') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_2_Max') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_3_Average') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_3_StdDev') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_3_Min') ?>

    <?php // echo $form->field($model, 'RMS_Watts_Ln_3_Max') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
