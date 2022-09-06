<?php
namespace app\widgets;

use yii\base\Widget;
use app\models\PlatformForm;
use app\models\ProjectForm;
use yii\data\Pagination;
use Yii;

class ProjectsKliet extends Widget
{
	public function run()
	{
		$platforms_db = PlatformForm::find()
			->leftJoin('node_project_platform', '`node_project_platform`.`id_platform` = `platforms`.`id`')
			->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `node_project_platform`.`id_project`')
			->where(['>','node_project_platform.id_project', 0])
			->where(['node_project_klient.id_klient' => Yii::$app->user->identity->id])
			->all();


		// echo '<pre>';
		// 	var_dump($platforms_db);
		// echo '</pre>';


		// die;


		// $query_platforms = ProjectForm::find()
        //     ->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `projects`.`id`')
        //     ->where(['node_project_klient.id_klient' => Yii::$app->user->identity->id])
        //     ->all();

		

		// Выводим платформы
       // $query_platforms = PlatformForm::find();

		// echo '<pre>';
		// var_dump($query_platforms);
		// echo '</pre>';
		// die;

		// Кол-во записей на странице
		// $number_records = 10;

		// $pages = new Pagination(['totalCount' => $query_platforms->count(), 'pageSize' => $number_records]);
		// $platforms_db = $query_platforms->offset($pages->offset)
		// 	->limit($pages->limit)
		// 	->all();
		// $platforms_count_db = PlatformForm::find()->count();
		

		return $this->render('projects_klient', [
			'platforms_db'          => $platforms_db,
			//'platforms_count_db'  => $platforms_count_db,
			//'pages'               => $pages,
			//'number_records'      => $number_records,
		]);
	}
}


?>