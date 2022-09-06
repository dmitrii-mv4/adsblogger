<?php

namespace app\models;

use yii\db\ActiveRecord;

class СreativesСommentsForm extends ActiveRecord
{
	// public $name;
	// public $account;
	// public $subscribers;
	// public $platform;

	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'creatives_comments';
	}

	// проверки
	public function rules()
	{
		return [
			['id_creative', 'id_creative'],
			['comment', 'comment'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			
		];
	}
}


?>