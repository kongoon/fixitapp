<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'แก้ไข '.$model->name;
?>
<h1><?=$this->title?></h1>
<?=$this->render('_form', [
    'model' => $model
])?>