<?php
/**
 * Created by HanumanIT Co., Ltd.
 * User: Manop Kongoon (kongoon@gmail.com)
 * Date: 1/9/2561
 * Time: 14:09
 */
namespace common\models;
use yii\base\Model;

class Bmi extends Model
{
    public $weight;
    public $height;

    public function rules()
    {
        return [
            [['height', 'weight'], 'required'],
            [['weight', 'height'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'height' => 'ส่วนสูง (เมตร)',
            'weight' => 'น้ำหนัก (กิโลกรัม)'
        ];
    }
    public function attributeHints()
    {
        return [
            'height' => 'ระบุส่วนสูงเป็นเมตร',
            'weight' => 'ระบุน้ำหนักเป็นกิโลกรัม'
        ];
    }
}