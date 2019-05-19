<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupMeterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Meters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-meter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Group Meter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'meter_id',
            'group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
