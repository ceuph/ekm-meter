<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeterSummary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meter-summary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meter_id')->textInput() ?>

    <?= $form->field($model, 'report')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_timestamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_timestamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kWh_Tot_Min')->textInput() ?>

    <?= $form->field($model, 'kWh_Tot_Max')->textInput() ?>

    <?= $form->field($model, 'kWh_Tot_Diff')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_1_Min')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_1_Max')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_1_Diff')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_2_Min')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_2_Max')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_2_Diff')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_3_Min')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_3_Max')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_3_Diff')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_4_Min')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_4_Max')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_4_Diff')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_1_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_1_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_1_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_1_Max')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_2_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_2_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_2_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_2_Max')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_3_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_3_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_3_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_3_Max')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_1_Average')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_1_StdDev')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_1_Min')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_1_Max')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_2_Average')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_2_StdDev')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_2_Min')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_2_Max')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_3_Average')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_3_StdDev')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_3_Min')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_3_Max')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_1_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_1_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_1_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_1_Max')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_2_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_2_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_2_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_2_Max')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_3_Average')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_3_StdDev')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_3_Min')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_3_Max')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
