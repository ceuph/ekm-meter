<?php

namespace app\controllers;

use Yii;
use app\models\MeterData;
use app\models\MeterDataSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeterDataController implements the CRUD actions for MeterData model.
 */
class MeterDataController extends Controller
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
     * Lists all MeterData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeterDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeterData model.
     * @param integer $meter_id
     * @param string $timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($meter_id, $timestamp)
    {
        return $this->render('view', [
            'model' => $this->findModel($meter_id, $timestamp),
        ]);
    }

    /**
     * Creates a new MeterData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MeterData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'timestamp' => $model->timestamp]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MeterData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $meter_id
     * @param string $timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($meter_id, $timestamp)
    {
        $model = $this->findModel($meter_id, $timestamp);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'timestamp' => $model->timestamp]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MeterData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $meter_id
     * @param string $timestamp
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($meter_id, $timestamp)
    {
        $this->findModel($meter_id, $timestamp)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MeterData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $meter_id
     * @param string $timestamp
     * @return MeterData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($meter_id, $timestamp)
    {
        if (($model = MeterData::findOne(['meter_id' => $meter_id, 'timestamp' => $timestamp])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
