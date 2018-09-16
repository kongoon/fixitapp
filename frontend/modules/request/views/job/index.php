<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\request\models\JobSearch */
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            'location',
            'request_by',
            'request_at',
            //'request_tel',
            //'receive_by',
            //'receive_at',
            //'repair_by',
            //'repair_at',
            //'repair_detail:ntext',
            //'feedback',
            //'remark:ntext',
            //'job_status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
