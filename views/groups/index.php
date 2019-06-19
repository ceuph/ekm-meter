<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Groups', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'html',
                'label' => 'Name',
                'value' => function($model, $key, $index, $column) {
                    return Html::a($model->name, ['groups/view', 'id' => $model->id]);
                }
            ],
            'description',
            [
                'format' => 'html',
                'label' => 'Members',
                'value' => function($model) {
                    $value = '';
                    foreach ($model->meters as $meter) {
                        if (strlen($value) > 0) {
                            $value .= '&nbsp;&nbsp;|&nbsp;&nbsp;';
                        }
                        $value .= Html::a($meter->name, ['meter/view', 'id' => $meter->id]);
                    }
                    return $value;
                }
            ],
        ],
    ]); ?>


</div>
