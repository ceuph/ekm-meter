<?php

namespace app\controllers;

use app\models\GroupsSearch;
use app\models\Variables;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $thisMonth = mktime(0,0,0,date('n'), 1);
        $emissionFactor = Variables::findOne(['name' => 'EmissionFactor']);
        $results = (new Query())
            ->select(['groups.id', 'groups.name', 'SUM(meter_summary.kWh_Tot_Diff) sum_diff'])
            ->from('groups')
            ->join('INNER JOIN', 'group_meter', 'group_meter.group_id = groups.id')
            ->join('INNER JOIN', 'meter', 'meter.id = group_meter.meter_id')
            ->join('LEFT JOIN', 'meter_summary', 'meter_summary.meter_id = meter.id')
            ->where('start_timestamp >= :min AND report = :report', [
                ':min' => $thisMonth,
                ':report' => 'mo'
            ])
            ->groupBy('groups.id, groups.name')
            ->orderBy('groups.name')
            ->all()
        ;

        $total = 0;
        foreach ($results as $result) {
            $total += (float)$result['sum_diff'];
        }
        return $this->render('index', [
            'total' => $total,
            'results' => $results,
            'emissionFactor' => $emissionFactor
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
