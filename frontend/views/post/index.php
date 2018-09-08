<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\grid\GridView;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\ArrayHelper;


$this->title = 'รายการข้อมูล';
?>
<h1><?=$this->title?></h1>
<?=Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success'])?>
<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'updated_at:datetime',
        [
            'attribute' => 'created_by',
            'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
            'value' => function($model){
                return $model->createdBy->username;
            }
        ],
        [
            'label' => 'ทดสอบ',
            'value' => function($model){
                return $model->id == 2 ? 'Yes' : 'No';
            }
        ],
        ['class' => 'yii\grid\ActionColumn']
    ]
])?>