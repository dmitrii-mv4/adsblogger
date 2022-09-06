<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProjectsPlatformsForm extends ActiveRecord
{
	public static function tableName()
	{
		return 'projects_platforms';
	}

	public function rules()
	{
		return [
			//[['title'], 'required', 'message' => 'Поле обязательное для заполнения'],
		];
	}
}


?>