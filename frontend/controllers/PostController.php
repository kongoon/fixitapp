<?php
namespace frontend\controllers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use common\models\Post;
use frontend\models\PostSearch;
use Yii;
use yii\data\ActiveDataProvider;

class PostController extends \yii\web\Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?']
                    ]
                ]
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => ['delete' => ['POST']]
            ]
        ];
    }
    public function actionIndex()
    {
        $searModel = new PostSearch();
        
        $dataProvider = $searModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searModel
        ]);
    }
    public function actionCreate()
    {
        $model = new Post();
        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->setFlash('success', 'แก้ไขข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
            }
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->loadModel($id)]);
    }
    public function actionDelete($id)
    {
        if($this->loadModel($id)->delete()){
            Yii::$app->session->addFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
            Yii::$app->session->addFlash('info', 'เรียบร้อย');
        }else{
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด');
        }
        return $this->redirect(['index']);
    }
    
    public function loadModel($id)
    {
        $model = Post::findOne($id);
        if(!$model){
            throw new \yii\web\NotFoundHttpException();
        }
        return $model;
    }
}
