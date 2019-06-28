<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 26/06/2019
 * Time: 9:29 AM
 */

namespace app\controllers;


use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGroups()
    {

    }
}