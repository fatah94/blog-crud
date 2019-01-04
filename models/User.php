<?php

namespace app\models;

use app\models\Account;
use yii\web\IdentityInterface;

class User extends Account implements IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return User::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return User::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

}
