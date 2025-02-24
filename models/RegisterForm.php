<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{

    public $name;
    public $email;
    public $password;
    public $password_repeat;
    public $img;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Пожалуйста, укажите имя'],
            ['name', 'string', 'min' => '4', 'max' => '255', 'message' => 'Имя должно быть не менее 4 и не более 255 символов'],

            ['email', 'required', 'message' => 'Пожалуйста, укажите email'],
            ['email', 'email', 'message' => 'Email адрес должен быть корректного формата'],
            ['email', 'unique', 'targetClass' => User::class ,'message' => 'Email адрес занят'],

            ['password','string', 'min' => 8, 'max' => 64, 'message' => 'Пароль должен быть не менее 8 символов и не более 64'],
            ['password', 'required', 'message' => 'Пожалуйста, укажите пароль'],

            ['password_repeat', 'string', 'min' => 8, 'max' => 64, 'message' => 'Пароль должен быть не менее 8 символов и не более 64'],
            ['password_repeat', 'required', 'message' => 'Пожалуйста, повторите пароль'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],

            [['name', 'email', 'password', 'password_repeat'], 'trim'],
        ];
    }

    public function execute()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);

        $success = $user->insert(false);

        if ($success) {
            return Yii::$app->user->login($user, 3600 * 24);
        }

        return false;
    }
}