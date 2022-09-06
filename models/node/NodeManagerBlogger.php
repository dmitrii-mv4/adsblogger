<?php

namespace app\models\node;

use yii\db\ActiveRecord;

class NodeManagerBlogger extends ActiveRecord
{
	public static function tableName()
	{
		return 'node_manager_blogger';
	}
}

?>