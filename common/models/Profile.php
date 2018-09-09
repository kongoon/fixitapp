<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property int $department_id
 *
 * @property Department $department
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    public $username;
    public $email;
    
    public $uploadPhoto = 'uploads/photo';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'firstname', 'lastname', 'department_id'], 'required'],
            [['user_id', 'department_id'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
            ['photo', 'file', 'extensions' => 'jpg,png,gif'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'department_id' => 'Department ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function uploadPhoto($model, $attribute)
    {
        $photo = UploadedFile::getInstance($model, $attribute);
        if($photo){
            FileHelper::createDirectory($this->getUploadPath());
            if($model->isNewRecord || empty($model->photo)){
                $photo_name = time().'.'.$photo->extension;//'_'.$photo->baseName.
            }else{
                $photo_name = $model->getOldAttribute($attribute);
            }
            $photo->saveAs($this->getUploadPath().$photo_name);
            Image::thumbnail($this->getUploadPath().$photo_name, 200, 300)
                    ->resize(new Box(200, 300))
                    ->save($this->getUploadPath().$photo_name);
            return $photo_name;
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    public function getUploadPath()
    {
        return Yii::getAlias('@webroot').'/'.$this->uploadPhoto.'/';
    }
}
