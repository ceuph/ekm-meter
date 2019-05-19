<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupMeter */

$this->title = 'Create Group Meter';
$this->params['breadcrumbs'][] = ['label' => 'Group Meters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-meter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
