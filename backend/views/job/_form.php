<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_by')->textInput() ?>

    <?= $form->field($model, 'request_at')->textInput() ?>

    <?= $form->field($model, 'request_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receive_by')->textInput() ?>

    <?= $form->field($model, 'receive_at')->textInput() ?>

    <?= $form->field($model, 'repair_by')->textInput() ?>

    <?= $form->field($model, 'repair_at')->textInput() ?>

    <?= $form->field($model, 'repair_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'feedback')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'job_status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
