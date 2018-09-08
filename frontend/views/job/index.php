<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\JobStatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการแจ้งซ่อม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มรายการแจ้งซ่อม', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'content:ntext',
            'location',
            //'request_by',
            'request_at:datetime',
            'request_tel',
            'receive_by',
            'receive_at:datetime',
            'repair_by',
            'repair_at:datetime',
            'repair_detail:ntext',
            'feedback',
            'remark:ntext',
            [
                'attribute' => 'job_status_id',
                'filter' => ArrayHelper::map(JobStatus::find()->all(), 'id', 'name'),
                'value' => function($model){
                    return $model->jobStatus->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
