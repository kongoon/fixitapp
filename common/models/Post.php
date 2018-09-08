<?php
namespace common\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class Post extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }
    public static function tableName()
    {
        return 'post';
    }
    
    public function rules()
    {
        return [
            [['name', 'body'], 'required'],
            ['name', 'string', 'max' => 300],
            ['body', 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer']
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'name' => 'หัวข้อ',
            'body' => 'รายละเอียด',
            'created_at' => 'เพิ่มเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
            'created_by' => 'เพิ่มโดย',
            'updated_by' => 'แก้ไขโดย'
        ];
    }
    
    public function attributeHints()
    {
        return [
            'name' => 'ระบุเรื่อง',
            'body' => 'ระบุรายละเอียด'
        ];
    }
    
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

