<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeterData */

$this->title = 'Update Meter Data: ' . $model->meter_id;
$this->params['breadcrumbs'][] = ['label' => 'Meter Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->meter_id, 'url' => ['view', 'meter_id' => $model->meter_id, 'timestamp' => $model->timestamp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meter-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
