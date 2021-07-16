<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

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


 *
 * @property Msg[] $msgs
 * @property PriceList[] $priceLists
 * @property Project[] $projects
 * @property Project[] $projects0
 * @property Project[] $projects1

 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER= 'manager';
    const ROLE_MAIN_ARTIST= 'main_artist';
    const ROLE_ARTIST= 'artist';

    public $roles;
    /**
     * @var mixed|null
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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'telegram', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
           // [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
            ['roles', 'safe'],
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
           // 'role_id' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Msgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
       $this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveRoles']);

    }

    /**
     * Revoke old roles and assign new if any
     */
    public function saveRoles()
    {
        Yii::$app->authManager->revokeAll($this->getId());


                if ($role = Yii::$app->authManager->getRole($this->roles)) {
                    Yii::$app->authManager->assign($role, $this->getId());
                }

    }

    /**
     * Populate roles attribute with data from RBAC after record loaded from DB
     */
    public function afterFind()
    {
        $this->roles = $this->getRoles();
    }

    /**
     * Get user roles from RBAC
     * @return array
     */
    public function getRoles()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->getId());

        return ArrayHelper::getColumn($roles, 'name', false);

    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getMsgs()
    {
        return $this->hasMany(Msg::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[PriceLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceLists()
    {
        return $this->hasMany(PriceList::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['artist_id' => 'id']);
    }

    /**
     * Gets query for [[Projects0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects0()
    {
        return $this->hasMany(Project::class, ['main_artist_id' => 'id']);
    }

    /**
     * Gets query for [[Projects1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects1()
    {
        return $this->hasMany(Project::class, ['manager_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getRole()
//    {
//       // return $this->(AuthAssignment::class, ['user_id' => 'id']);
//    }

    public function getRoleDropdown(){

        return[
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_MANAGER => 'Manager',
            self::ROLE_MAIN_ARTIST => 'Main_artist',
            self::ROLE_ARTIST => 'Artist',
        ];
    }
}
