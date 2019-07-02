<?php
/* @var $dropDownItems[] GroupsSearch */
use yii\helpers\Html;
?>
<?=$this->render('_form', ['dropDownItems' => $dropDownItems]) ?>
<?php if (Yii::$app->request->post()) : ?>
    <?=$this->render('_chart', ['data' => $data]) ?>
    <?=$this->render('_table', ['data' => $data]) ?>
<?php endif; ?>
