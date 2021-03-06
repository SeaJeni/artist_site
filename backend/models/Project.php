<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

//use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property int $stage_id
 * @property int $type_id
 * @property int $manager_id
 * @property int $main_artist_id
 * @property int $artist_id
 * @property string $start_time
 * @property string|null $end_time
 * @property string $deadline
 * @property float $cost
 * @property int $customer_id
 * @property string $roles
 
 * 
 * @property Msg[] $msgs
 * @property User $artist
 * @property Customer $customer
 * @property User $mainArtist
 * @property User $manager
 * @property Stage $stage
 * @property Type $type

 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */


    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'stage_id', 'type_id', 'manager_id', 'main_artist_id', 'artist_id',  'deadline', 'cost', 'customer_id'], 'required'],
            [['status', 'stage_id', 'type_id', 'manager_id', 'main_artist_id', 'artist_id', 'customer_id'], 'integer'],
            [['start_time', 'end_time', 'deadline'], 'safe'],
            [['cost'], 'number'],
            [['name','payment_status'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['main_artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['main_artist_id' => 'id']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['manager_id' => 'id']],
//            [['artist_id'], 'safe'],
//            [['main_artist_id'], 'safe'],
//            [['manager_id'], 'safe'],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::className(), 'targetAttribute' => ['stage_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '????????????????',
            'status' => '????????????',
            'stage_id' => '????????????',
            'type_id' => '??????',
            'manager_id' => '????????????????',
            'main_artist_id' => '?????????????? ????????????????',
            'artist_id' => '????????????????',
            'start_time' => '????????????',
            'end_time' => '??????????',
            'deadline' => '?????????????? ????????',
            'cost' => '??????????????????',
            'customer_id' => '????????????????',
            'payment_status' => '????????????',
            
        ];
    }
    public function behaviors()
        {
            return [
                //?????????????????????????? ?????????????????? TimestampBehavior ActiveRecord
                'timestamp' => [
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        \yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['start_time'],


                    ],
                    //?????????? ???????????????????????? 'value' => new \yii\db\Expression('NOW()'),
                    'value' => function(){
                                    return gmdate("Y-m-d");
                    },


                ],

            ];
    }
//    public function getUsersIdByRoles($roles){
//      return  $users = Yii::$app->authManager->getUserIdsByRole($roles);
//
//    }
    public function getArtist(){
      // $this->getUsersIdByRoles('artist');
        return $this->hasOne(User::className(), ['id' => 'artist_id']);
    }
    public function getMainArtist(){

    //  $users =  $this->getUsersIdByRoles('main_artist');
      return $this->hasOne(User::class, ['id' => 'main_artist_id']);
          //->andOnCondition(['id'=> $users]);

    }
    public function getManager(){
      //  $this->getUsersIdByRoles('manager');
        return $this->hasOne(User::className(), ['id' => 'manager_id']);
    }


    /**
     * Gets query for [[Msgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsgs()
    {
        return $this->hasMany(Msg::className(), ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Artist]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getArtist()
//    {
//        return $this->hasOne(User::className(), ['id' => 'artist_id']);
//    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[MainArtist]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getMainArtist()
//    {
//        return $this->hasOne(User::className(), ['id' => 'main_artist_id']);
//    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getManager()
//    {
//        return $this->hasOne(User::className(), ['id' => 'manager_id']);
//    }

    /**
     * Gets query for [[Stage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStage()
    {
        return $this->hasOne(Stage::className(), ['id' => 'stage_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }


}
