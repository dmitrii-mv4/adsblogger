<?php

namespace app\models\node;

use yii\db\ActiveRecord;

class NodeProjectBlogger extends ActiveRecord
{
	public static function tableName()
	{
		return 'node_project_blogger';
	}
}

?>