<?php

namespace app\models;

use yii\db\ActiveRecord;

class BloggerForm extends ActiveRecord
{
	// public $name;
	// public $account;
	// public $subscribers;
	// public $platform;

	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'bloggers';
	}

	// проверки
	public function rules()
	{
		return [
			[['name'], 'required', 'message' => 'Поле обязательное для заполнения'],
			['email', 'email'],
			['phone', 'number'],

			// добавляем поля (чтобы они попали в переменную $models в контроллере)
			['account', 'safe'],
			// ['platform', 'safe'],
			// ['id_platform', 'safe'],
			['responsible_manager', 'safe'],
			['description', 'safe'],
			['comment_topic', 'safe'],
			['blogger_preference', 'safe'],
			['email', 'safe'],
			['phone', 'safe'],

			// ['url', 'safe'],
			// ['subscribers', 'safe'],
			// ['coverage', 'safe'],
			// ['integration_cost', 'safe'],
			// ['cpm', 'safe'],
			// ['cpv', 'safe'],
			// ['audience_gender', 'safe'],
			// ['involvement', 'safe'],
			// ['involvement_promotional_post', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'name' => 'Имя блогера: *',
			'id_category' => 'Категория: *',
			'account' => 'Аккаунт:',
			'responsible_manager' => 'Ответственный менеджер:',
			'responsible_klient' => 'Клиент:',
			'create_date' => 'Дата создания:',
			'description' => 'Описание аккаунта:',
			'comment_topic' => 'Комментарий по тематике:',
			'blogger_preference' => 'Предпочтение блогера:',
			'phone' => 'Телефон:',
			'update_date' => 'Редактировался:',
		];
	}
}


?>