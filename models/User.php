<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['img', 'string'],
            ['token', 'string'],
            ['is_deleted', 'boolean'],
            ['created_at', 'safe'],

        ];
    }

    public function setPassword(string $password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword(string $password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }


    public function validateAuthKey($authKey)
    {
        return $this->token === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->token = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function getAuthKey()
    {
        return $this->token;
    }
}