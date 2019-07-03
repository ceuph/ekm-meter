<?php
/* @var $dropDownItems[] GroupsSearch */
use yii\helpers\Html;
$this->title = 'Reports';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ucfirst($granularity);
?>
<div class="row">
    <div class="col-lg-12">
        <h1>Compare by <?= ucfirst($granularity) ?></h1>
    </div>
</div>
<?=$this->render('_form', ['dropDownItems' => $dropDownItems, 'granularity' => $granularity]) ?>
<?php if (Yii::$app->request->get('id')) : ?>
    <?=$this->render('_chart', ['data' => $data]) ?>
    <?=$this->render('_table', ['data' => $data]) ?>
<?php endif; ?>
