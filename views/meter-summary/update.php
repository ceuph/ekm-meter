<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeterSummary */

$this->title = 'Update Meter Summary: ' . $model->meter_id;
$this->params['breadcrumbs'][] = ['label' => 'Meter Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->meter_id, 'url' => ['view', 'meter_id' => $model->meter_id, 'report' => $model->report, 'start_timestamp' => $model->start_timestamp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meter-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
