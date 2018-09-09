<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\JobStatus;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการงานซ่อม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มรายการ', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'request_by',
                'value' => function($model){
                    return isset($model->requestBy->profile) ? $model->requestBy->profile->getFullname() : null;
                }
            ],
            //'request_by',
            'request_at:datetime',
            'request_tel',
            [
                'attribute' => 'receive_by',
                'value' => function($model){
                    return isset($model->receiveBy->profile) ? $model->receiveBy->profile->getFullname() : null;
                }
            ],
            //'receive_by',
            'receive_at:datetime',
            [
                'attribute' => 'repair_by',
                'value' => function($model){
                    return isset($model->repairBy->profile) ? $model->repairBy->profile->getFullname() : null;
                }
            ],
            //'repair_by',
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
            [
                'format' => 'raw',
                'value' => function($model){
                    $r = '';
                    if($model->job_status_id == 1){
                        $r .= Html::a('รับงาน', ['receive', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning', 'data' => ['confirm' => 'ต้องการรับงานนี้?']]);
                        $r .= ' ';
                        $r .= Html::a('ยกเลิก', ['reject', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', 'data' => ['confirm' => 'ต้องการยกเลิกงานนี้?']]);
                    }
                    if($model->job_status_id == 2){
                        $r .= Html::a('งานเสร็จแล้ว', ['complete', 'id' => $model->id], ['class' => 'btn btn-xs btn-success', 'data' => ['confirm' => 'งานนี้เสร็จแล้ว?']]);
                        $r .= ' ';
                        $r .= Html::a('ยกเลิก', ['reject', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', 'data' => ['confirm' => 'ต้องการยกเลิกงานนี้?']]);
                    }
                    return $r;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', ['class' => 'job-view', 
                            'data' => [
                                'id' => $model->id,
                                'target' => '#job-modal',
                                'toggle' => 'modal'
                            ]
                        ]);
                    },
                    
                ]
            ],
        ],
    ]); ?>
    </div>
</div>

<?php 
Modal::begin([
    'id' => 'job-modal',
    'header' => '<h4 class="modal-title"></h4>',
    'size' => 'modal-lg',
]);
Modal::end();
?>
<?php $this->registerJs('
function init_click(){
    $(".job-view").click(function(e){
        var job_id = $(this).data("id");
        $.get("'.Url::to(['view'], true).'",
            {
                id: job_id
            },
            function(data){
                $("#job-modal").find(".modal-body").html(data);
                $(".modal-body").html(data);
                $(".modal-title").html("ข้อมูลการแจ้ง");
                $("#job-modal").modal("show");
            }  
        );
    }); 
}
init_click();
')?>