<?php

namespace backend\controllers;

use Yii;
use common\models\Job;
use backend\models\JobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->job_status_id == 2 && empty($model->receive_by)){
                $model->receive_by = Yii::$app->user->getId();
                $model->receive_at = time();
            }
            if($model->job_status_id >=3 && empty($model->repair_by)){
                $model->repair_by = Yii::$app->user->getId();
                $model->repair_at = time();
            }
            if($model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
            }
            return $this->redirect(['index']);
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionReceive($id)
    {
        $model = $this->findModel($id);
        $model->receive_by = Yii::$app->user->getId();
        $model->receive_at = time();
        $model->job_status_id = 2;
        if($model->save()){
            Yii::$app->session->setFlash('success', 'รับงานเรียบร้อยแล้ว');
        }else{
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
        }
        return $this->redirect(['index']);
    }
    
    public function actionComplete($id)
    {
        $model = $this->findModel($id);
        $model->repair_by = Yii::$app->user->getId();
        $model->repair_at = time();
        $model->job_status_id = 3;
        if($model->save()){
            Yii::$app->session->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว');
        }else{
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
        }
        return $this->redirect(['index']);
    }
    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->repair_by = Yii::$app->user->getId();
        $model->repair_at = time();
        $model->job_status_id = 4;
        if($model->save()){
            Yii::$app->session->setFlash('success', 'ยกเลิกเรียบร้อยแล้ว');
        }else{
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
        }
        return $this->redirect(['index']);
    }
}
