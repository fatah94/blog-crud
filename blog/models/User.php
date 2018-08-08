<?php

namespace app\models;
use yii\db\Query;
use yii\web\IdentityInterface;
use yii\base\BaseObject;
use app\models\Account;

class User extends BaseObject implements IdentityInterface
{
    public $username;
    public $password;
    public $name;
    public $role;

    public static function findOne($username)
    {
        $data = Account::find()->where(['username' => $username])->one();

        $user = new User();
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->name = $data['name'];
        $user->role = $data['role'];

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null){}

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne($username);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {}

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {}

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
