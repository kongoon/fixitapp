<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobStatus */

$this->title = 'Create Job Status';
$this->params['breadcrumbs'][] = ['label' => 'Job Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
