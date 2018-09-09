<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Department;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'user.username',
            //'user.email',
            [
                'attribute' => 'username',
                'value' => function($model){
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'email',
                'value' => function($model){
                    return $model->user->email;
                }
            ],
            'firstname',
            'lastname',
            [
                'attribute' => 'department_id',
                'filter' => ArrayHelper::map(Department::find()->all(), 'id', 'name'),
                'value' => function($model){
                    return $model->department->name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_profile'
])?>
