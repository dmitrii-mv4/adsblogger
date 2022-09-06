<?php

namespace app\models;

use yii\db\ActiveRecord;

class DataPlatformsForm extends ActiveRecord
{
	// public $name;
	// public $account;
	// public $subscribers;
	// public $platform;

	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'data_platforms';
	}

	// // проверки
	public function rules()
	{
		return [
			[['account'], 'required', 'message' => 'Напите аккаунт площадки'],
			[['account_link'], 'required', 'message' => 'Напишите ссылку на аккаунт площадки'],
			[['subscribers'], 'required', 'message' => 'Напишите кол-во подписчиков у аккаунта'],
			[['coverage'], 'required', 'message' => 'Напишите охват аккаунта'],
			[['integration_cost'], 'required', 'message' => 'Напишите стоимость интеграции'],

			['id_platform', 'safe'],
			['id_blogger', 'safe'],
			['account', 'safe'],
			['account_link', 'safe'],
			['subscribers', 'safe'],
			['coverage', 'safe'],
			['integration_cost', 'safe'],
			['format', 'safe'],
			['involvement', 'safe'],
			['involvement_promotional_post', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
            'id_platform'                   => 'Платформа',
            'id_blogger'                    => 'Блогер',
            'account'                       => 'Аккаунт *',
            'account_link'                  => 'Ссылка на аккаунт *',
            'subscribers'                   => 'Подписчиков *',
            'coverage'                      => 'Охват *',
            'integration_cost'              => 'Стоимость интеграции *',
            'format'                        => 'Формат',
            'involvement'                   => 'Вовлечённость',
            'involvement_promotional_post'  => 'Вовлечённость по рекламным постам',
            'audience_gender'               => 'Пол аудитории',
            'update_date'                   => 'Дата редактирования',
            'create_date'                   => 'Дата создания',
		];
	}
}


?>