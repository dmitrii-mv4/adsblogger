<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProjectForm extends ActiveRecord
{
	public static function tableName()
	{
		return 'projects';
	}

	public function rules()
	{
		return [
			[['title'], 'required', 'message' => 'Поле обязательное для заполнения'],
			['budget', 'number'],
			
			['budget', 'safe'],
			['balance', 'safe'],
		];
	}

	// переводы
	public function attributeLabels()
	{
		return [
			'title'        => 'Название проекта: *',
			'id_platform'  => 'Привязка к проекту:',
			'budget'       => 'Бюджет:',
			'create_date'  => 'Дата создания:',
			'update_date'  => 'Дата редактирования:',
		];
	}
}


?>