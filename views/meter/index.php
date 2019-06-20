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

    <?php
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'name',
                    'label' => 'Name',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Meter */
                        return Html::a($model->name, ['view', 'id' => $model->id]);
                    }
                ],
                'description',
                [
                    'label' => 'Latest Hourly Data',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Meter */
                        $max = $model->getMeterSummaries()->where(['report' => 'hr'])->max('start_timestamp');
                        $tz = new DateTimeZone('Asia/Manila');
                        $hr = new DateTime('@' . $max);
                        $hr->setTimezone($tz);
                        return Html::a(
                                $hr->format('M d, Y h:i A'), [
                                    'meter-summary/index',
                                    'sort' => 'start_timestamp',
                                    'MeterSummarySearch' =>  [
                                        'meter_id' => $model->id,
                                        'min_start_timestamp' => strtotime('today', $max),
                                        'max_start_timestamp' => strtotime('tomorrow', $max) - 1,
                                        'report' => 'hr'
                                    ]
                                ]
                        );
                    }
                ],
                [
                    'label' => 'Latest Daily Data',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Meter */
                        $max = $model->getMeterSummaries()->where(['report' => 'dy'])->max('start_timestamp');
                        $tz = new DateTimeZone('Asia/Manila');
                        $dy = new DateTime('@' . $max);
                        $dy->setTimezone($tz);
                        return Html::a($dy->format('M d, Y'), [
                            'meter-summary/index',
                            'sort' => 'start_timestamp',
                            'MeterSummarySearch' => [
                                'meter_id' => $model->id,
                                'min_start_timestamp' => strtotime('first day of this month', $max),
                                'max_start_timestamp' => strtotime('last day of this month', $max) + (24 * 60 * 60) - 1,
                                'report' => 'dy'
                            ]
                        ]);
                    }
                ],
                [
                    'label' => 'Latest Weekly Data',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Meter */
                        $max = $model->getMeterSummaries()->where(['report' => 'wk'])->max('start_timestamp');
                        $tz = new DateTimeZone('Asia/Manila');
                        $wk = new DateTime('@' . $max);
                        $wk->setTimezone($tz);

                        $wk2 = new DateTime('@' . $model->getMeterSummaries()->where(['report' => 'wk'])->max('end_timestamp'));
                        $wk2->setTimezone($tz);
                        return Html::a($wk->format('M d-') . $wk2->format('M d, Y'), [
                            'meter-summary/index',
                            'sort' => 'start_timestamp',
                            'MeterSummarySearch' =>  [
                                'meter_id' => $model->id,
                                'min_start_timestamp' => strtotime(date('Y', $max) . '-01-01T00:00:00+08:00'),
                                'max_start_timestamp' => strtotime(date('Y', $max) . '-12-31T11:59:59+08:00'),
                                'report' => 'wk'
                            ]
                        ]);
                    }
                ],
                [
                    'label' => 'Latest Monthly Data',
                    'format' => 'html',
                    'value' => function ($model) {
                        /* @var $model \app\models\Meter */
                        $max = $model->getMeterSummaries()->where(['report' => 'mo'])->max('start_timestamp');
                        $tz = new DateTimeZone('Asia/Manila');
                        $mo = new DateTime('@' . $max);
                        $mo->setTimezone($tz);
                        return Html::a($mo->format('M Y'), [
                            'meter-summary/index',
                            'sort' => '-start_timestamp',
                            'MeterSummarySearch' => [
                                'meter_id' => $model->id,
                                'min_start_timestamp' => strtotime(date('Y', $max) . '-01-01T00:00:00+08:00'),
                                'max_start_timestamp' => strtotime(date('Y', $max) . '-12-31T11:59:59+08:00'),
                                'report' => 'mo'
                            ]
                        ]);
                    }
                ]

            ],
        ]);
    } catch (Exception $e) {
        echo 'An error occurred while displaying meter data.';
    }
    ?>


</div>
