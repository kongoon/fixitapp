<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Department;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')?>
    
    <?= $form->field($user, 'password_hash')?>
    
    <?= $form->field($user, 'email')?>
    
    <?= $form->field($profile, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profile, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profile, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->all(), 'id', 'name')) ?>
    
    <?= $form->field($user, 'role')->dropDownList([1 => 'User', 9 => 'Administrator'])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
