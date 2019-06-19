<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\GroupMeter */
/* @var $form yii\widgets\ActiveForm */
?>

<?= DetailView::widget([
    'model' => $groups,
    'attributes' => [
        'name',
        'description',
    ],
]) ?>

<div class="group-meter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meter_id')->dropDownList(ArrayHelper::map($meters, 'id', 'name')) ?>

    <?= $form->field($model, 'group_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
