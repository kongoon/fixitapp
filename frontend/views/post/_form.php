<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin()?>

<?=$form->errorSummary($model)?>

<?=$form->field($model, 'name')?>

<?=$form->field($model, 'body')->textarea(['rows' => 6])?>

<?=Html::submitButton('บันทึกข้อมูล', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end()?>