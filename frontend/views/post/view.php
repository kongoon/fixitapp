<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = Html::encode($model->name);
?>
<h1><?=$this->title?></h1>

<?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'body',
        'created_at:datetime',
        'updated_at:datetime',
        'createdBy.username',
        'updatedBy.username',
        [
            'attribute' => 'created_by',
            'format' => 'raw',
            'label' => 'ผู้เพิ่ม',
            'value' => Html::a($model->createdBy->username, [
                '/user/view', 'id' => $model->created_by
            ], [
                'class' => 'btn btn-xs btn-warning', 
                'target' => '_blank'
                ])
        ],
        [
            'attribute' => 'updated_by',
            'value' => $model->updatedBy->username
        ]
    ]
])?>

<?=HtmlPurifier::process($model->body)?>