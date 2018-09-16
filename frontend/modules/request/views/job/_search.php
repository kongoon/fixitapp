<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\request\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'request_by') ?>

    <?= $form->field($model, 'request_at') ?>

    <?php // echo $form->field($model, 'request_tel') ?>

    <?php // echo $form->field($model, 'receive_by') ?>

    <?php // echo $form->field($model, 'receive_at') ?>

    <?php // echo $form->field($model, 'repair_by') ?>

    <?php // echo $form->field($model, 'repair_at') ?>

    <?php // echo $form->field($model, 'repair_detail') ?>

    <?php // echo $form->field($model, 'feedback') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'job_status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
