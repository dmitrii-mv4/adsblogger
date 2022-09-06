<?php

namespace app\models;

use yii\db\ActiveRecord;

class CreativeForm extends ActiveRecord
{
	public static function tableName()
	{
		return 'creatives';
	}

	public function rules()
	{
		return [
			[['media_link'], 'required', 'message' => 'Сылка на креатив обязателяна'],
			[['media_link'], 'url', 'message' => 'Вы указали не верный тип ссылки'],
			
			['media_link', 'safe'],
			['description', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'format'      => 'Формат:',
			'media_link'  => 'Ссылка на видео или фото:',
			'description' => 'Текст:',
		];
	}
}


?>