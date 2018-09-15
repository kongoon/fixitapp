<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = $model->content;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?php
   
    $r = '';
    if($model->job_status_id == 1){
        $r .= Html::a('รับงาน', ['receive', 'id' => $model->id], ['class' => 'btn btn-warning', 'data' => ['confirm' => 'ต้องการรับงานนี้?']]);
        $r .= ' ';
        $r .= Html::a('ยกเลิก', ['reject', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'ต้องการยกเลิกงานนี้?']]);
    }
    /*if($model->job_status_id == 2){
        $r .= Html::a('งานเสร็จแล้ว', ['complete', 'id' => $model->id], ['class' => 'btn btn-success', 'data' => ['confirm' => 'งานนี้เสร็จแล้ว?']]);
        $r .= ' ';
        $r .= Html::a('ยกเลิก', ['reject', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'ต้องการยกเลิกงานนี้?']]);
    }*/
    echo $r;
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'content:ntext',
            'location',
            [
                'attribute' => 'request_by',
                'value' => isset($model->requestBy->profile) ? $model->requestBy->profile->getFullname() : null,
            ],
            'request_at:datetime',
            'request_tel',
            [
                'attribute' => 'receive_by',
                'value' => isset($model->receiveBy->profile) ? $model->receiveBy->profile->getFullname() : null,
            ],
            'receive_at:datetime',
            [
                'attribute' => 'repair_by',
                'value' => isset($model->repairBy->profile) ? $model->repairBy->profile->getFullname() : null,
            ],
            'repair_at:datetime',
            'repair_detail:ntext',
            'feedback',
            'remark:ntext',
            [
                'attribute' => 'job_status_id',
                'value' => $model->jobStatus->name,
            ],
        ],
    ]) ?>
    
    <?php if($act == 'complete' || $act == 'reject'){?>
        <?php $form = ActiveForm::begin()?>
        <?= $form->field($model, 'repair_detail')->textarea()?>
        <?= Html::submitButton(($act == 'complete' ? 'บันทึกข้อมูล' : 'ยกเลิกงานนี้'), 
                ['class' => 'btn btn-'.($act == 'complete' ? 'success' : 'danger')])
        ?>
        <?php ActiveForm::end()?>
    <?php }?>

</div>
