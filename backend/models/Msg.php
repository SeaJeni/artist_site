<?php

namespace backend\models;

use floor12\files\models\File;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

//use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "msg".
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id

 * @property string $msg
 * @property string $date
 *
 * @property Project $project
 * @property User $user
 * @property-read File[] $documents
 */
class Msg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'msg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[[ 'msg'], 'required'],
            [['user_id', 'project_id'], 'integer'],
            [['date'], 'integer'],
            [['msg'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['documents', 'file', 'extensions' => ['docx', 'jpg', 'png', 'jpeg',  'psd'], 'maxFiles' => 10],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'project_id' => 'Проекты',
            'msg' => 'Msg',
            'date' => 'Date',

        ];
    }
public function behaviors()
    {
       return [
            //Использование поведения TimestampBehavior ActiveRecord для вывода текущего времени в сообщении
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['date'],


                ],
                //можно использовать 'value' => new \yii\db\Expression('NOW()'),
                'value' => new \yii\db\Expression('NOW()'),


            ],
           'files' => [
               'class' => 'floor12\files\components\FileBehaviour',
               'attributes' => [
                   'documents',
               ],
           ],
        ];
    }
    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
