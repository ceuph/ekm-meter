<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Variables */

$this->title = 'Update Variables: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="variables-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
