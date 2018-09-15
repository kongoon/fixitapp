<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property string $content รายการที่แจ้ง
 * @property string $location สถานที่
 * @property int $request_by ผู้แจ้ง
 * @property int $request_at วันที่แจ้ง
 * @property string $request_tel เบอร์โทรผู้แจ้ง
 * @property int $receive_by รับเรื่องโดย
 * @property int $receive_at รับเรื่องเมื่อ
 * @property int $repair_by ดำเนินการโดย
 * @property int $repair_at ดำเนินการเมื่อ
 * @property string $repair_detail ผลการดำเนินการ
 * @property int $feedback ประเมิน
 * @property string $remark หมายเหตุ
 * @property int $job_status_id สถานะ
 *
 * @property JobStatus $jobStatus
 * @property User $requestBy
 * @property User $receiveBy
 * @property User $repairBy
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'location', 'request_by', 'request_at', 'request_tel', 'job_status_id'], 'required'],
            [['content', 'repair_detail', 'remark'], 'string'],
            [['request_by', 'request_at', 'receive_by', 'receive_at', 'repair_by', 'repair_at', 'feedback', 'job_status_id'], 'integer'],
            [['location'], 'string', 'max' => 100],
            [['request_tel'], 'string', 'max' => 45],
            [['job_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobStatus::className(), 'targetAttribute' => ['job_status_id' => 'id']],
            [['request_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['request_by' => 'id']],
            [['receive_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receive_by' => 'id']],
            [['repair_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['repair_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'รายการที่แจ้ง',
            'location' => 'สถานที่',
            'request_by' => 'ผู้แจ้ง',
            'request_at' => 'วันที่แจ้ง',
            'request_tel' => 'เบอร์โทรผู้แจ้ง',
            'receive_by' => 'รับเรื่องโดย',
            'receive_at' => 'รับเรื่องเมื่อ',
            'repair_by' => 'ดำเนินการโดย',
            'repair_at' => 'ดำเนินการเมื่อ',
            'repair_detail' => 'ผลการดำเนินการ',
            'feedback' => 'ประเมิน',
            'remark' => 'หมายเหตุ',
            'job_status_id' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobStatus()
    {
        return $this->hasOne(JobStatus::className(), ['id' => 'job_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestBy()
    {
        return $this->hasOne(User::className(), ['id' => 'request_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiveBy()
    {
        return $this->hasOne(User::className(), ['id' => 'receive_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairBy()
    {
        return $this->hasOne(User::className(), ['id' => 'repair_by']);
    }
}
