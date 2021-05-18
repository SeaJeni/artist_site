<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "price_list".
 *
 * @property int $id
 * @property int $user_id
 * @property int $stage_id
 * @property int $type_id
 * @property float $price
 *
 * @property Stage $stage
 * @property Type $type
 * @property User $user
 */
class PriceList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'stage_id', 'type_id', 'price'], 'required'],
            [['user_id', 'stage_id', 'type_id'], 'integer'],
            [['price'], 'number'],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::className(), 'targetAttribute' => ['stage_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'user_id' => 'Пользователь',
            'stage_id' => 'Вид работы',
            'type_id' => 'Тип',
            'price' => 'Цена',
        ];
    }

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
