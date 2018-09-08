<?php
/**
 * Created by HanumanIT Co., Ltd.
 * User: Manop Kongoon (kongoon@gmail.com)
 * Date: 1/9/2561
 * Time: 14:31
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Bmi Calculator';
$this->params['breadcrumbs'][] = ['label' => 'Bmi', 'url' => ['/bmi/index', 'test' => 'hello']];
$this->params['breadcrumbs'][] = $this->title;

//var_dump($model);
?>

<?php $form = ActiveForm::begin()?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'height')?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'weight')?>
    </div>
</div>

<?=Html::submitButton('คำนวณ', ['class' => 'btn btn-success'])?>

<?php ActiveForm::end()?>

<?=!empty($bmi) ? $bmi : ''?>


