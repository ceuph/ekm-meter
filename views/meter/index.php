<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Meter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Name',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->name, ['view', 'id' => $model->id]);
                }
            ],
            'description',
            [
                'label' => 'Latest Hourly Data',
                'format' => 'html',
                'value' => function($model) {
                    $tz = new DateTimeZone('Asia/Manila');
                    $hr = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'hr'])->max('start_timestamp'));
                    $hr->setTimezone($tz);
                    return $hr->format('M d, Y @ H:i');
                }
            ],
            [
                'label' => 'Latest Daily Data',
                'format' => 'html',
                'value' => function($model) {
                    $tz = new DateTimeZone('Asia/Manila');
                    $dy = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'dy'])->max('start_timestamp'));
                    $dy->setTimezone($tz);
                    return $dy->format('M d, Y');
                }
            ],
            [
                'label' => 'Latest Weekly Data',
                'format' => 'html',
                'value' => function($model) {
                    $tz = new DateTimeZone('Asia/Manila');
                    $wk = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'wk'])->max('start_timestamp'));
                    $wk->setTimezone($tz);

                    $wk2 = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'wk'])->max('end_timestamp'));
                    $wk2->setTimezone($tz);
                    return $wk->format('M d-') . $wk2->format('M d, Y');
                }
            ],
            [
                'label' => 'Latest Monthly Data',
                'format' => 'html',
                'value' => function($model) {
                    $tz = new DateTimeZone('Asia/Manila');
                    $mo = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'mo'])->max('start_timestamp'));
                    $mo->setTimezone($tz);
                    return $mo->format('M Y');
                }
            ]

        ],
    ]); ?>


</div>
