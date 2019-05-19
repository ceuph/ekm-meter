<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupMeter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-meter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meter_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
