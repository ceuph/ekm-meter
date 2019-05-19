<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupMeter */

$this->title = 'Update Group Meter: ' . $model->meter_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Meters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->meter_id, 'url' => ['view', 'meter_id' => $model->meter_id, 'group_id' => $model->group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-meter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
