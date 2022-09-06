<?php

namespace app\models\node;

use yii\db\ActiveRecord;

class NodeKlientManager extends ActiveRecord
{
	public static function tableName()
	{
		return 'node_klient_manager';
	}
}

?>