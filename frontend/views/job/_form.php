<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->errorSummary($model)?>
    
    <?php if($model->job_status_id >= 3){?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'content',
                'location',
                'request_tel'
            ]
        ])?>
        <?= $form->field($model, 'feedback')->radioList([5 => 'มากที่สุด', 4 => 'มาก', 3 => 'ปานกลาง', 2 => 'น้อย', 1 => 'น้อยที่สุด']) ?>
    <?php }else{?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'request_tel')->textInput(['maxlength' => true]) ?></div>
    </div>   
    <?php }?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
