<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeterSummary */

$this->title = 'Create Meter Summary';
$this->params['breadcrumbs'][] = ['label' => 'Meter Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meter-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
