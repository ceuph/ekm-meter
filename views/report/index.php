<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h1>Meter Reports</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2>Compare Meters</h2>

                <p>Compare multiple meter readings based on a specified date range.</p>

                <p><?= Html::a('Create Report &raquo;', ['report/meter'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Compare Groups</h2>

                <p>Compare multiple group readings based on a specified date range.</p>

                <p><?= Html::a('Create Report &raquo;', ['report/groups'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>
    </div>
</div>
