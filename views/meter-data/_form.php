<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeterData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meter-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meter_id')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'hour')->textInput() ?>

    <?= $form->field($model, 'minute')->textInput() ?>

    <?= $form->field($model, 'weekday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'week')->textInput() ?>

    <?= $form->field($model, 'apiversion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kWh_Tot')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_1')->textInput() ?>

    <?= $form->field($model, 'kWh_Tariff_2')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_1')->textInput() ?>

    <?= $form->field($model, 'RMS_Volts_Ln_2')->textInput() ?>

    <?= $form->field($model, 'Rev_kWh_Tot')->textInput() ?>

    <?= $form->field($model, 'Rev_kWh_Tariff_1')->textInput() ?>

    <?= $form->field($model, 'Rev_kWh_Tariff_2')->textInput() ?>

    <?= $form->field($model, 'Power_Factor_Ln_1')->textInput() ?>

    <?= $form->field($model, 'Power_Factor_Ln_2')->textInput() ?>

    <?= $form->field($model, 'Power_Factor_Ln_3')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Max_Demand')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Tot')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_1')->textInput() ?>

    <?= $form->field($model, 'RMS_Watts_Ln_2')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_1')->textInput() ?>

    <?= $form->field($model, 'Amps_Ln_2')->textInput() ?>

    <?= $form->field($model, 'Max_Demand_Period')->textInput() ?>

    <?= $form->field($model, 'CT_Ratio')->textInput() ?>

    <?= $form->field($model, 'Meter_Status_Code')->textInput() ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
