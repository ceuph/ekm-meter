<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 26/06/2019
 * Time: 9:29 AM
 */

namespace app\controllers;


use app\models\GroupsSearch;
use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMeter()
    {

    }

    public function actionGroups()
    {
        $groups = GroupsSearch::find()->all();
        return $this->render('groups',[
            'groups' => $groups
        ]);
    }
}