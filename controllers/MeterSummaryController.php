<?php

namespace app\controllers;

use Yii;
use app\models\MeterSummary;
use app\models\MeterSummarySearch;
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
        ];
    }

    /**
     * Lists all MeterSummary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeterSummarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
     * @return mixed
     */
    public function actionCreate()
    {
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
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($meter_id, $report, $start_timestamp)
    {
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
     * @param integer $meter_id
     * @param string $report
     * @param string $start_timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($meter_id, $report, $start_timestamp)
    {
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
