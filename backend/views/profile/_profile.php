<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-3">
        <?=Html::img('http://via.placeholder.com/200x200', ['class' => 'img-thumbnail'])?>
    </div>
    <div class="col-md-9">
        <h3><?=$model->firstname?> <?=$model->lastname?></h3>
        <span class="glyphicon glyphicon-user"></span> <?=$model->user->username?>
        <span class="glyphicon glyphicon-envelope"></span> <?=$model->user->email?>
    </div>
</div>


