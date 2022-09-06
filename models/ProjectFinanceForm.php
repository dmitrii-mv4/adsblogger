<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProjectFinanceForm extends ActiveRecord
{
	public static function tableName()
	{
		return 'project_finance';
	}
}


?>