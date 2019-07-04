<?php

namespace app\controllers;

use Yii;
use app\models\MeterSummary;
use app\models\MeterSummarySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeterSummaryController implements the CRUD actions for MeterSummary model.
 */
class MeterSummaryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'roles' => ['@']]
                ]
            ]
        ];
    }

    /**
     * Lists all MeterSummary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;
        $prevParams = $queryParams;
        $nextParams = $queryParams;
        $searchModel = new MeterSummarySearch();
        $dataProvider = $searchModel->search($queryParams);
        $meter = $searchModel->meter;
        $title_prefix = '';
        $date_format = '';
        $chart_title = 'KWh Total Difference';
        switch ($queryParams['MeterSummarySearch']['report']) {
            case 'hr':
                $title_prefix = 'Hourly ';
                $date_format = 'h:i A';
                $prevParams['MeterSummarySearch']['max_start_timestamp'] = $queryParams['MeterSummarySearch']['min_start_timestamp'] - 1;
                $prevParams['MeterSummarySearch']['min_start_timestamp'] = strtotime('yesterday', $queryParams['MeterSummarySearch']['min_start_timestamp']);
                $nextParams['MeterSummarySearch']['min_start_timestamp'] = $queryParams['MeterSummarySearch']['max_start_timestamp'] + 1;
                $nextParams['MeterSummarySearch']['max_start_timestamp'] = strtotime('+1 day', $queryParams['MeterSummarySearch']['max_start_timestamp']);
                $dataProvider->setPagination(['pageSize' => 24]);
                break;
            case 'dy':
                $title_prefix = 'Daily ';
                $date_format = 'M d, Y';
                $prevParams['MeterSummarySearch']['min_start_timestamp'] = strtotime('first day of previous month',$queryParams['MeterSummarySearch']['min_start_timestamp']);
                $prevParams['MeterSummarySearch']['max_start_timestamp'] = strtotime('last day of previous month',$queryParams['MeterSummarySearch']['min_start_timestamp']) + (24 * 60 * 60) - 1;
                $nextParams['MeterSummarySearch']['min_start_timestamp'] = strtotime('first day of next month',$queryParams['MeterSummarySearch']['min_start_timestamp']);
                $nextParams['MeterSummarySearch']['max_start_timestamp'] = strtotime('last day of next month',$queryParams['MeterSummarySearch']['min_start_timestamp']) + (24 * 60 * 60) - 1;
                $dataProvider->setPagination(['pageSize' => 31]);
                break;
            case 'wk':
                $title_prefix = 'Weekly ';
                $date_format = 'M d, Y';
                $prevParams['MeterSummarySearch']['min_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) - 1 . '-01-01T00:00:00+08:00');
                $prevParams['MeterSummarySearch']['max_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) - 1 . '-12-31T11:59:59+08:00');
                $nextParams['MeterSummarySearch']['min_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) + 1 . '-01-01T00:00:00+08:00');
                $nextParams['MeterSummarySearch']['max_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) + 1 . '-12-31T11:59:59+08:00');
                $dataProvider->setPagination(['pageSize' => 100]);
                break;
            case 'mo':
                $title_prefix = 'Monthly ';
                $date_format = 'M Y';
                $prevParams['MeterSummarySearch']['min_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) - 1 . '-01-01T00:00:00+08:00');
                $prevParams['MeterSummarySearch']['max_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) - 1 . '-12-31T11:59:59+08:00');
                $nextParams['MeterSummarySearch']['min_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) + 1 . '-01-01T00:00:00+08:00');
                $nextParams['MeterSummarySearch']['max_start_timestamp'] = strtotime(date('Y', $queryParams['MeterSummarySearch']['min_start_timestamp']) + 1 . '-12-31T11:59:59+08:00');
                $dataProvider->setPagination(['pageSize' => 12]);
                break;
        }

        $chartLabels = [];
        $kwhTotDiffs = [];
        foreach($dataProvider->getModels() as $summary) {
            /* @var $summary \app\models\MeterSummary */
            $chartLabels[] = date($date_format, $summary->start_timestamp);
            $kwhTotDiffs[] = $summary->kWh_Tot_Diff;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title_prefix' => $title_prefix,
            'meter' => $meter,
            'chartLabels' => $chartLabels,
            'kwhTotDiffs' => $kwhTotDiffs,
            'chart_title' => $chart_title,
            'prevParams' => $prevParams,
            'nextParams' => $nextParams,
            'queryParams' => $queryParams
        ]);
    }

    /**
     * Displays a single MeterSummary model.
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($meter_id, $report, $start_timestamp)
    {
        return $this->render('view', [
            'model' => $this->findModel($meter_id, $report, $start_timestamp),
        ]);
    }

    /**
     * Creates a new MeterSummary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $override
     * @return mixed
     * @throws NotFoundHttpException if override string is not provided.
     */
    public function actionCreate($override)
    {
        if ('m3t3r' != $override) {
            throw new NotFoundHttpException('Error deleting summary.');
        }
        $model = new MeterSummary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'report' => $model->report, 'start_timestamp' => $model->start_timestamp]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MeterSummary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $override
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($override, $meter_id, $report, $start_timestamp)
    {
        if ('m3t3r' != $override) {
            throw new NotFoundHttpException('Error deleting summary.');
        }
        $model = $this->findModel($meter_id, $report, $start_timestamp);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'report' => $model->report, 'start_timestamp' => $model->start_timestamp]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MeterSummary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $override
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($override, $meter_id, $report, $start_timestamp)
    {
        if ('m3t3r' != $override) {
            throw new NotFoundHttpException('Error deleting summary.');
        }
        $this->findModel($meter_id, $report, $start_timestamp)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MeterSummary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return MeterSummary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($meter_id, $report, $start_timestamp)
    {
        if (($model = MeterSummary::findOne(['meter_id' => $meter_id, 'report' => $report, 'start_timestamp' => $start_timestamp])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
