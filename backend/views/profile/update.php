<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = 'แก้ไข: ' . $profile->firstname.' '.$profile->lastname;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $profile->user_id, 'url' => ['view', 'id' => $profile->user_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'profile' => $profile,
        'user' => $user
    ]) ?>

</div>
