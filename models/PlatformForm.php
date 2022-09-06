<?php

namespace app\models;

use yii\db\ActiveRecord;

class PlatformForm extends ActiveRecord
{
	public static function tableName()
	{
		return 'platforms';
	}

	public function rules()
	{
		return [
			[['title'], 'required', 'message' => 'Поле обязательное для заполнения'],

			['img', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'title' => 'Название платформы: *',
			'img' => 'Сылка на изображение: *',
		];
	}
}


?>