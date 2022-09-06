<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserForm extends ActiveRecord
{
	// public $name;
	// public $account;
	// public $subscribers;
	// public $platform;

	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'user';
	}

	// public function getTableLinksForm()
    // {
    //     return $this->hasOne(TableLinksForm::className(), ['id' => 'manager_id']);
    // }

	// проверки
	public function rules()
	{
		return [
			[['username'], 'required', 'message' => 'Поле обязательное для заполнения'],
			[['name'], 'required', 'message' => 'Поле обязательное для заполнения'],
			['username', 'email', 'message' => 'Не корректный E-mail'],
			['phone', 'number'],
			['phone', 'required'],

			// добавляем поля (чтобы они попали в переменную $models в контроллере)
			['name', 'safe'],
			['password', 'safe'],
			['password_repeat', 'safe'],
			['phone', 'safe'],
			['name_company', 'safe'],
			['description', 'safe'],
			['url_site', 'safe'],
			['avatar', 'safe'],
			['password', 'safe'],
			['password_repeat', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'username'        => 'E-mail: *',
			'role'            => 'Роль:',
			'password'        => 'Пароль: *',
			'name' 	          => 'Имя: *',
			'phone' 	      => 'Телефон: *',
			'name_company'    => 'Наименование компании: *',
			'description'     => 'Описание компании:',
			'url_site'        => 'Сайт:',
			'signup_date'     => 'Дата создания:',
			'avatar'     	  => 'Ссылка на аватар:',
		];
	}
}


?>