<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Sort;

use yii\web\NotFoundHttpException; // 404

use app\models\User;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\BloggerForm;
use app\models\PlatformForm;
use app\models\node\NodeKlientBlogger;
use app\models\node\NodeProjectKlient;
use app\models\node\NodeProjectBlogger;
use app\models\CreativeForm;
use app\models\CategoryForm;
use app\models\СreativesСommentsForm;
use app\models\ProjectForm;
use app\models\DataPlatformsForm;

class KlientController extends Controller
{
    public $coverage_micro   = 100000;
    public $coverage_average = 700000;

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'index'], // действия в контроллере
                'rules' => [ // правила к действиям
                    [
                        'allow' => true,
                        'actions' => ['login'], // действия в контроллере
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'], // действия в контроллере
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) // запрещаем доступ всем
                        {
                            //return \Yii::$app->user->identity->role === 'admin';

                            switch (Yii::$app->user->identity->role) {
                                case 'admin':
                                    return \Yii::$app->getResponse()->redirect('/manager');
                                    break;

                                case 'manager':
                                    return \Yii::$app->getResponse()->redirect('/manager');
                                    break;

                                case 'klient':
                                    return true;
                                    break;
                                
                                default:
                                    throw new HttpException(403, 'Forbidden');
                                    break;
                            }

                            // старый функционал доступа
                            // if(\Yii::$app->user->identity->role == 'admin' || 'manager')
                            // {
                            //     return \Yii::$app->getResponse()->redirect('/admin');
                            //     //throw new HttpException(403/*or any code*/, 'Forbidden'/*or any message*/);
                            // } else {
                            //     return true;
                            // }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->layout = 'klient';
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Выводим блогеров по платформе
        $bloggers_neutral_platforms_db = BloggerForm::find()
            ->leftJoin('data_platforms', '`data_platforms`.`id_blogger` = `bloggers`.`id`')
            ->leftJoin('node_klient_blogger', '`node_klient_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where(['data_platforms.id_platform' => Yii::$app->request->get('platform')])
            ->andWhere(['node_klient_blogger.id_klient' => Yii::$app->user->identity->id])
            ->orderBy('id desc')
            ->all();


        // echo "<pre>";
        //     var_dump($bloggers_neutral_platforms_db);
        // echo "</pre>";

        // die;

        // Выводим всех блогеров по проекту (нейтральные)
        $bloggers_neutral_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 0,
                'node_project_blogger.agreed' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту (отклонённые)
        $bloggers_rejected_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 2,
                'node_project_blogger.agreed' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту (согласованные)
        $bloggers_approved_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1,
                'node_project_blogger.agreed' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров привязыных к клиенту
        $bloggers_db = BloggerForm::find()
            ->leftJoin('node_klient_blogger', '`node_klient_blogger`.`id_blogger` = `bloggers`.`id`')
            ->where(['node_klient_blogger.id_klient' => Yii::$app->user->identity->id])
            ->all();

        // Выводим блогеров из таблицы связей для обновлений статусов
        $node_project_blogger_db = NodeProjectBlogger::find()->where(['id_project' => Yii::$app->request->get('project')])->all();

        if ($this->request->isPost) 
        {
            // Обработка статусов блогеров по id
            foreach ($node_project_blogger_db as $node_project_blogger)
            {
                // ========================== LOG CREATE ================================= //

                    $str_log = '================================================';

                    $array = array(
                            'Controller' => 'Klient',
                            'Method' => 'Index',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $node_project_blogger->id_blogger,
                            'long_list'  => $this->request->post('status_'.$node_project_blogger->id_blogger)
                    );
                                         
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/funnel_klient.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                // ======================== END LOG CREATE =============================== //

                // Массовое редактирование статусов
                // BloggerForm::updateAll(['long_list_status_manager' => 0], ['id' => array('11','30','31')]);

                NodeProjectBlogger::updateAll(
                    ['long_list' => $this->request->post('status_'.$node_project_blogger->id_blogger)], 
                    [
                        'id_project'    => Yii::$app->request->get('project'),
                        'id_blogger'    => $node_project_blogger->id_blogger,
                        //'id_blogger'  => array('1','2','6')
                    ]);
            }
            
            return $this->redirect(['?project='.Yii::$app->request->get('project')]);
        }

        return $this->render('index', [
            'platforms_db'         => $platforms_db,
            'bloggers_db'          => $bloggers_db,

            'bloggers_neutral_db'   => $bloggers_neutral_db,
            'bloggers_approved_db'  => $bloggers_approved_db,
            'bloggers_rejected_db'  => $bloggers_rejected_db,

            'bloggers_neutral_platforms_db'   => $bloggers_neutral_platforms_db,
            'bloggers_approved_platforms_db'  => $bloggers_approved_platforms_db,
            'bloggers_rejected_platforms_db'   => $bloggers_rejected_platforms_db,

            'bloggers_neutral_projects_db'    => $bloggers_neutral_projects_db,
            'bloggers_approved_projects_db'   => $bloggers_approved_projects_db,
            'bloggers_rejected_projects_db'   => $bloggers_rejected_projects_db,
        ]);
    }

    public function actionAgreed()
    {
        $bloggers_db = BloggerForm::find()->orderBy('id desc')->all();

        // Выводим всех блогеров по проекту (нейтральные)
        $bloggers_neutral_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 0,
                'node_project_blogger.waiting_creatives' => 0
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту (отклонённые)
        $bloggers_rejected_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 2,
                'node_project_blogger.waiting_creatives' => 0
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту (согласованные)
        $bloggers_approved_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 1,
                'node_project_blogger.waiting_creatives' => 0
            ])
            ->orderBy('id desc')
            ->all();


        // Выводим проекты из таблицы связей для обновлений статусов
        $node_project_blogger_db = NodeProjectBlogger::find()->where(['id_project' => Yii::$app->request->get('project')])->all();

        if ($this->request->isPost)
        {
            // Обработка статусов
            foreach ($node_project_blogger_db as $node_project_blogger)
            {
                // ========================== LOG CREATE ================================= //

                    $str_log = '================================================';

                    $array = array(
                            'Controller' => 'Klient',
                            'Method' => 'Agreed',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $node_project_blogger->id_blogger,
                            'long_list'  => $this->request->post('status_'.$node_project_blogger->id_blogger)
                    );
                                         
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/funnel_klient.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                // ======================== END LOG CREATE =============================== //
                
                // Массовое редактирование статусов
                // BloggerForm::updateAll(['long_list_status_manager' => 0], ['id' => array('11','30','31')]);
 
                NodeProjectBlogger::updateAll(
                    ['agreed' => $this->request->post('status_'.$node_project_blogger->id_blogger)], 
                    [
                        'id_project'    => Yii::$app->request->get('project'),
                        'id_blogger'    => $node_project_blogger->id_blogger,
                        //'id_blogger'  => array('1','2','6')
                    ]);

                // ------ ИЗМЕНЕНИЕ БЮДЖЕТА ------ //

                $bloggers_projects_db = NodeProjectBlogger::find()->Where(['agreed' => 1])->all();

                // Бюджет проекта
                $projects_db = ProjectForm::find()->Where(['id' => Yii::$app->request->get('project')])->all();

                foreach($projects_db as $projects)
                {
                    $project_budget = $projects->budget;
                }

                
                $all_reserve = array();

                // Биндим всех блоггеров
                foreach ($bloggers_db as $bloggers)
                {
                    // Если статус "Согласованные"
                    if ($this->request->post('status_'.$bloggers->id) == 1)
                    {
                        // Выводим сумму интеграции
                        $data_platforms__integration_cost_agreed = DataPlatformsForm::find()
                            ->where(['id_blogger' => $bloggers->id])
                            ->all();

                        // Объеденяем цены в один массив
                        $all_reserve[]=floatval($data_platforms__integration_cost_agreed[0]->integration_cost);
                    }
                }

                    
                // Резерв default
                $summ_all_prices = 0;
                
                // Складываем все цены прилетевшиеся из post
                foreach($all_reserve as $reserve)
                {
                    $summ_all_prices += $reserve;
                }

                $project_budget = $project_budget - $summ_all_prices;

                // Обновляем резерв бюджета в проекте
                ProjectForm::updateAll(
                [
                    'reserve' => $summ_all_prices,
                    'balance' => $project_budget,
                ], 
                [
                    'id' => Yii::$app->request->get('project')
                ]);
            }
            
            return $this->redirect(['agreed?project='.Yii::$app->request->get('project')]);
        }

        return $this->render('agreed', [
            //'bloggers_active_db' => $bloggers_active,
            //'bloggers_off_db'    => $bloggers_off,
            'bloggers_neutral_db'    => $bloggers_neutral_db,
            'bloggers_approved_db'   => $bloggers_approved_db,
            'bloggers_rejected_db'   => $bloggers_rejected_db,

            'bloggers_neutral_platforms_db'  => $bloggers_neutral_platforms_db,
            'bloggers_approved_platforms_db' => $bloggers_approved_platforms_db,
            'bloggers_rejected_projects_db'  => $bloggers_rejected_projects_db,

            'bloggers_neutral_projects_db'    => $bloggers_neutral_projects_db,
            'bloggers_approved_projects_db'   => $bloggers_approved_projects_db,
            'bloggers_rejected_projects_db'   => $bloggers_rejected_projects_db,

            'coverage_micro'                => $this->coverage_micro,
            'coverage_average'              => $this->coverage_average
            
        ]);
    }

    public function actionWork()
    {
        // Выводим всех блогеров по проекту которые прошли этап "Согласованные"
        $bloggers_waiting_creatives_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 1, 
                'node_project_blogger.waiting_creatives' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту которые прошли этап Загрузки креативов менеджера
        $bloggers_agreed_creative_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 1, 
                'node_project_blogger.waiting_creatives' => 1,
                'node_project_blogger.agreed_creative' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту которые прошли этап Креативы на согласовании
        $bloggers_pending_publication_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 1, 
                'node_project_blogger.waiting_creatives' => 1,
                'node_project_blogger.agreed_creative' => 1,
                'node_project_blogger.confirmed' => 0,
            ])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту которые прошли этап Ожидает публикации
        $bloggers_confirmed_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 1, 
                'node_project_blogger.waiting_creatives' => 1,
                'node_project_blogger.agreed_creative' => 1,
                'node_project_blogger.confirmed' => 1,
            ])
            ->orderBy('id desc')
            ->all();


        // Вытягиваем креативы
        $creative_db = CreativeForm::find()
            ->where(['id_project' => Yii::$app->request->get('project')])
            ->orderBy('id desc')
            ->all();

        // Вытягиваем креативы которые согласованные
        $creative_agreed_db = CreativeForm::find()
            ->where(['id_project' => Yii::$app->request->get('project'), 'status_agreed_klient' => 1])
            ->orderBy('id desc')
            ->all();

        // Вытаскиваем клиента который привязан к проекту
        // $node_project_klient = NodeProjectKlient::find()->Where(['id_project' => Yii::$app->request->get("project")])->one();

        // // Выводим блогеров из таблицы связей для обновлений статусов
        // $node_klient_blogger_db = NodeKlientBlogger::find()->where(['id_klient' => $node_project_klient->id_klient])->all();

        // // Выводим всех клиентов которые привязаные к менеджеру
        // $manager_node_klient_db = User::find()
        //     //->select('id')
        //     ->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
        //     ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
        //     ->orderBy('id desc')
        //     ->all();

        // // Вытягивает данные сравнивая с 2х таблиц (для проектов)
        // $bloggers_work_db = BloggerForm::find()
        //     ->leftJoin('node_klient_blogger', '`node_klient_blogger`.`id_blogger` = `bloggers`.`id`')
        //     ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `node_klient_blogger`.`id_blogger`')
        //     ->Where(['node_klient_blogger.agreed' => 1])
        //     ->andWhere(['node_project_blogger.id_project' => Yii::$app->request->get('project')])
        //     ->orderBy('id desc')
        //     ->all();

        // Выводим проекты из таблицы связей для обновлений статусов
        $node_project_blogger_db = NodeProjectBlogger::find()->where(['id_project' => Yii::$app->request->get('project')])->all();

        // Форматы для креативов
        $format_img[0] = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
        $format_video[0] = array('mp4', 'avi', 'MP4', 'AVI');


        if ($this->request->isPost)
        {
            // echo '<pre>';
            //     var_dump($this->request->post());
            // echo '</pre>';

            // die;

            // Обработка креативов ДА
            if ($this->request->post('agreed_id_creative_btn'))
            {
                CreativeForm::updateAll(
                ['status_agreed_klient' => 1],
                [
                    'id'  => $this->request->post('agreed_id_creative_btn'),
                ]);

                return $this->redirect('/klient/work?project='.Yii::$app->request->get('project'));
            }

            // Обработка креативов НЕТ
            if ($this->request->post('rejected_id_creative_btn'))
            {
                CreativeForm::updateAll(
                ['status_agreed_klient' => 2],
                [
                    'id'  => $this->request->post('rejected_id_creative_btn'),
                ]);

                return $this->redirect('/klient/work?project='.Yii::$app->request->get('project'));
            }

            // Если поступил комментарий по креативу
            if ($this->request->post('comment_id_creative_btn'))
            {
                foreach ($creative_db as $creative)
                {              
                    // Если коментарий не пустой, то отправляем в БД
                    if ($this->request->post('comment_creative_'.$creative->id))
                    {
                        //$creative_comment_model->create_date = date("Y-m-d H:i:s"); // дата добавления

                        $creative_comment_db = [
                            'id_creative' => 'id_creative',
                            'comment' => 'comment',
                            'create_user_id' => 'create_user_id',
                            'create_date' => 'create_date'
                        ];

                        $creative_comment_post = [
                            'comment_id_creative_btn' => $this->request->post('comment_id_creative_btn'),
                            'comment_creative_' => $this->request->post('comment_creative_'.$creative->id),
                            'create_user_id' => Yii::$app->user->identity->id,
                            'create_date' => date("Y-m-d H:i:s"),
                        ];

                        Yii::$app->db->createCommand()->batchInsert('creatives_comments', $creative_comment_db, [$creative_comment_post])->execute();
                    }
                }

                return $this->redirect('/klient/work?project='.Yii::$app->request->get('project'));
            }
        }

        return $this->render('work', [
            'bloggers_waiting_creatives_db' => $bloggers_waiting_creatives_db,
            'bloggers_agreed_creative_db' => $bloggers_agreed_creative_db,
            'bloggers_pending_publication_db' => $bloggers_pending_publication_db,
            'bloggers_confirmed_db' => $bloggers_confirmed_db,
            'creative_db' => $creative_db,
            'creative_agreed_db' => $creative_agreed_db,

            'format_img'   => $format_img,
            'format_video' => $format_video,
        ]);
    }

    public function actionJa()
    {
            $data = array();
            $entry = Yii::$app->request->get('entry');
            $page = Yii::$app->request->get('page');
            $per_page = Yii::$app->request->get('per_page');
            $off = ($page - 1) * $per_page;
            
            if($entry == 'klient_1')
            {
                $users = User::find()
                    ->where(['role' => ['klient']])
                    ->orderBy('id desc')
                    ->limit($per_page)
                    ->offset($off)
                    ->all();
            }



            // if($entry == 'klient_2') {
            //     $users = User::find()
            // ->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
            // ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id, 'user.role' => ['klient']])
            // ->limit($per_page)
            // ->offset($off)
            // ->all();    
            // }
            // if($entry == 'klient_4') {
            //     $users = BloggerForm::find()
            // ->orderBy('id desc')
            // ->limit($per_page)
            // ->offset($off)
            // ->all();    
            // }
            
            $data = array(
                'its' => $users,
            );  
            return  $this->renderPartial($entry, array(
                'data'=>$data,
            ));            
    }
}
