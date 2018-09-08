<?php
/**
 * Created by HanumanIT Co., Ltd.
 * User: Manop Kongoon (kongoon@gmail.com)
 * Date: 1/9/2561
 * Time: 14:27
 */
namespace frontend\controllers;

use common\models\Bmi;
use Yii;

class BmiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $bmi = null;
        $model = new Bmi();
        if($model->load(Yii::$app->request->post())){
            $bmi = $model->weight / ($model->height * $model->height);
        }
        return $this->render('index', [
            'model' => $model,
            'bmi' => $bmi
        ]);
    }
}