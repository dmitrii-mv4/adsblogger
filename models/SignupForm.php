<?php

namespace app\models;

use yii\db\ActiveRecord;

class SignupForm extends ActiveRecord
{
	// public $username;
	// public $password;

	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'user';
	}

	// проверки
	public function rules()
	{
		return [
			[['username', 'password'], 'required', 'message' => 'Поле обязательное для заполнения'],
			[['password'], 'string', 'min' => 6],
			['username', 'email', 'message' => 'Не правильный E-mail'],
			['username', 'unique', 'targetClass' => User::className(), 'message' => 'Этот E-mail уже зарегистрирован'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'username' => 'E-mail',
			'password' => 'Пароль',
		];
	}
}


?>