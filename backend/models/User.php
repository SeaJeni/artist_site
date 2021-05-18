<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $telegram
 * @property string|null $avatar
 * @property int $role_id
 *
 * @property Msg[] $msgs
 * @property PriceList[] $priceLists
 * @property Project[] $projects
 * @property Project[] $projects0
 * @property Project[] $projects1
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'role_id'], 'required'],
            [['status', 'created_at', 'updated_at', 'role_id'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'telegram', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'telegram' => 'Телеграм',
            'avatar' => 'Аватар',
            'role_id' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Msgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsgs()
    {
        return $this->hasMany(Msg::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PriceLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceLists()
    {
        return $this->hasMany(PriceList::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['artist_id' => 'id']);
    }

    /**
     * Gets query for [[Projects0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects0()
    {
        return $this->hasMany(Project::className(), ['main_artist_id' => 'id']);
    }

    /**
     * Gets query for [[Projects1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects1()
    {
        return $this->hasMany(Project::className(), ['manager_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
