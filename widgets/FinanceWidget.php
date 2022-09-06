<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\ProjectForm;
use app\models\node\NodeProjectBlogger;
use app\models\DataPlatformsForm;
use app\models\ProjectFinance;

class FinanceWidget extends Widget
{
	public function run()
	{
		// switch (Yii::$app->controller->action->id) {
		// 	case 'index':
		// 		$this->long_list();
		// 		break;

		// 	case 'agreed':
		// 		$this->agreed();
		// 		break;

		// 	case 'work':
		// 		$this->work();
		// 		break;
				
		// 	default:
		// 		echo 'Нужно выбрать проект';
		// 		break;
		// }


		$projects_db = ProjectForm::find()->where(['id' => Yii::$app->request->get('project')])->all();
		
		// $node_project_blogger_db = NodeProjectBlogger::find()
		// 	//->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
		// 	->where([
		// 		'id_project' => Yii::$app->request->get('project'),
		// 		'long_list' => 1
		// 	])
		// 	->all();

		$node_project_blogger_db = DataPlatformsForm::find()
			->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `data_platforms`.`id_blogger`')
			->where([
				'node_project_blogger.long_list' => 1,
				'node_project_blogger.id_project' => Yii::$app->request->get('project')
			])
			->all();


		// foreach ($node_project_blogger_db as $value)
		// {
		// 	echo $value->integration_cost.'<br/><br/>';

		// 	//$sum = array_sum($value->integration_cost);

		// 	//echo $sum;
		// }

		// echo '<pre>';
		// 	var_dump($node_project_blogger_db['0']);
		// echo '</pre>';

		return $this->render('finance', [
			'projects_db' => $projects_db,
			//'node_project_blogger_db' => $node_project_blogger_db
		]);
	}

	public function long_list()
	{
		$projects_db = ProjectForm::find()->where(['id' => Yii::$app->request->get('project')])->all();


		return $this->render('finance', [
			'projects_db' => $projects_db,
			//'node_project_blogger_db' => $node_project_blogger_db
		]);
	}

	// public function agreed()
	// {
	// 	echo 'agreed';
	// }

	// public function work()
	// {
	// 	echo 'work';
	// }
}

?>