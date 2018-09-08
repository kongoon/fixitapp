<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\JobStatus;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Job', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'content:ntext',
            'location',
            'request_by',
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
</div>
