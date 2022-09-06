<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\PlatformForm;
use app\models\User;
use app\models\ProjectForm;
use app\models\node\NodeProjectKlient;

class ProjectsManager extends Widget
{
	public function run()
	{
		$projects_db = ProjectForm::find()->all();
		$platforms_db = PlatformForm::find()->all();

		// Выводим всех клиентов которые связаны с менеджером
		$users_klient_db = User::find()
			->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->orderBy('id desc')
			->limit(1)
			->all();
		$users_klient_count_db = User::find()
			->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->orderBy('id desc')
			->count();


		// Клиенты которые в работе у менеджера
		$klients_in_work_db = User::find()
			->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->where(['>','node_klient_manager.id_project', 0])
			->orderBy('id desc')
			->limit(1)
			->all();
		$klients_in_work_count_db = User::find()
			->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->where(['>','node_klient_manager.id_project', 0])
			->orderBy('id desc')
			->count();


		// Клиенты без проетов
		$klient_no_project_db = User::find()
			->leftJoin('node_project_klient','`node_project_klient`.`id_klient` = `user`.`id`')
			->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->where(['node_klient_manager.id_project' => 0])
			->orderBy('id desc')
			->limit(1)
			->all();
		$klient_no_project_count_db = User::find()
			->leftJoin('node_project_klient','`node_project_klient`.`id_klient` = `user`.`id`')
			->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
			->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
			->where(['node_klient_manager.id_project' => 0])
			->orderBy('id desc')
			->count();


		return $this->render('projects_manager', [
			'platforms_db'                => $platforms_db,
			'users_klient_db'             => $users_klient_db,
			'users_klient_count_db'       => $users_klient_count_db,
			'klients_in_work_db'          => $klients_in_work_db,
			'klients_in_work_count_db'    => $klients_in_work_count_db,
			'klient_no_project_db'        => $klient_no_project_db,
			'klient_no_project_count_db'  => $klient_no_project_count_db,
		]);
	}
}

?>