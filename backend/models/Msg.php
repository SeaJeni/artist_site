<?php

namespace backend\models;

use Yii;

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
            [['user_id', 'project_id', 'msg'], 'required'],
            [['user_id', 'project_id'], 'integer'],
            [['date'], 'safe'],
            [['msg'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'project_id' => 'Project ID',
            'msg' => 'Msg',
            'date' => 'Date',
        ];
    }
public function behaviors()
    {
        return [
            //Использование поведения TimestampBehavior ActiveRecord
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                    

                ],
                //можно использовать 'value' => new \yii\db\Expression('NOW()'),
                'value' => function(){
                                return gmdate("Y-m-d H:i:s");
                },


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
