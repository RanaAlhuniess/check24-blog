<?php

use app\core\Application;
use app\core\db\DbModel;

class User extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public function register()
    {
        return '';
    }

    public static function tableName(): string
    {
        return 'users';
    }
    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            //TODO: addError
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            //TODO: addError
            return false;
        }

        return Application::$app->login($user);
    }
    public function logout() {

    }

}