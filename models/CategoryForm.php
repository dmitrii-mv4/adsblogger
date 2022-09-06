<?php

namespace app\models;

use yii\db\ActiveRecord;

class CategoryForm extends ActiveRecord
{
	// Добавляем нужную таблицу БД
	public static function tableName()
	{
		return 'categories';
	}

	// проверки
	public function rules()
	{
		return [
			[['title'], 'required', 'message' => 'Поле обязательное для заполнения'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
            'title' => 'Название',
		];
	}
}


?>