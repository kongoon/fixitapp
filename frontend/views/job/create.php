<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = 'เพิ่มรายการแจ้งซ่อม';
$this->params['breadcrumbs'][] = ['label' => 'รายการแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
