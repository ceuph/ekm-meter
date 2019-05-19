<?php

namespace app\controllers;

use Yii;
use app\models\GroupMeter;
use app\models\GroupMeterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupMeterController implements the CRUD actions for GroupMeter model.
 */
class GroupMeterController extends Controller
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
     * Lists all GroupMeter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupMeterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupMeter model.
     * @param integer $meter_id
     * @param string $group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($meter_id, $group_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($meter_id, $group_id),
        ]);
    }

    /**
     * Creates a new GroupMeter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GroupMeter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'group_id' => $model->group_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GroupMeter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $meter_id
     * @param string $group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($meter_id, $group_id)
    {
        $model = $this->findModel($meter_id, $group_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'meter_id' => $model->meter_id, 'group_id' => $model->group_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GroupMeter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $meter_id
     * @param string $group_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($meter_id, $group_id)
    {
        $this->findModel($meter_id, $group_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupMeter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $meter_id
     * @param string $group_id
     * @return GroupMeter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($meter_id, $group_id)
    {
        if (($model = GroupMeter::findOne(['meter_id' => $meter_id, 'group_id' => $group_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
