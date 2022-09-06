<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

use yii\web\HttpException; // 403 страница
use yii\web\NotFoundHttpException; // вызвать 404 ошибку

use app\models\BloggerForm;
use yii\data\Sort;
use app\models\DataPlatformsForm;
use app\models\User;
use app\models\node\NodeKlientBlogger;
use app\models\node\NodeProjectKlient;
use app\models\CreativeForm;
use app\models\node\NodeProjectBlogger;
use app\models\CategoryForm;
use app\models\ProjectForm;

class ManagerController extends Controller
{
    public $layout;

    public $coverage_micro   = 100000;
    public $coverage_average = 700000;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true, // разрешаем всё
                        'roles' => ['@'], // @ - зареганный // ? - гость
                        'matchCallback' => function($rule, $action) // запрещаем доступ всем
                        {
                            //return \Yii::$app->user->identity->role === 'admin';

                            switch (Yii::$app->user->identity->role) {
                                case 'admin':
                                    return true;
                                    break;

                                case 'manager':
                                    return true;
                                    break;

                                case 'klient':
                                    throw new HttpException(403/*or any code*/, 'Forbidden'/*or any message*/);
                                    break;
                                
                                default:
                                    throw new HttpException(403/*or any code*/, 'Forbidden'/*or any message*/);
                                    break;
                            }

                            // старый функционал доступа
                            // if(\Yii::$app->user->identity->role == ('admin' or 'manager'))
                            // {
                            //     return true;
                            // } else {
                            //     //return \Yii::$app->getResponse()->redirect('/web');
                            //     throw new HttpException(403/*or any code*/, 'Forbidden'/*or any message*/);
                            // }
                        }
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->layout = 'manager';
    }

    public function actionIndex()
    {
        $bloggers_db = BloggerForm::find()->orderBy('id desc')->all();

        // Вытаскиваем клиента который привязан к проекту
        $node_project_klient = NodeProjectKlient::find()->Where(['id_project' => Yii::$app->request->get("project")])->one();

        $data_platforms_db = DataPlatformsForm::find()->all();

        // Выводим всех клиентов которые привязаные к менеджеру
        $manager_node_klient_db = User::find()
            ->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
            ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
            ->orderBy('id desc')
            ->all();

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
                            'Controller' => 'Manager',
                            'Method' => 'Index',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $node_project_blogger->id_blogger,
                            'long_list'  => $this->request->post('status_'.$node_project_blogger->id_blogger)
                    );
                                     
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/funnel_manager.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

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
            'bloggers_db'                    => $bloggers_db,
            'bloggers_neutral_projects_db'   => $bloggers_neutral_projects_db,
            'bloggers_approved_projects_db'  => $bloggers_approved_projects_db,
            'bloggers_rejected_projects_db'  => $bloggers_rejected_projects_db,
        ]);
    }

    public function actionAgreed()
    {
        $bloggers_db = BloggerForm::find()->orderBy('id desc')->all();

        // Вытаскиваем клиента который привязан к проекту
        $node_project_klient = NodeProjectKlient::find()->Where(['id_project' => Yii::$app->request->get("project")])->one();

        // Выводим всех клиентов которые привязаные к менеджеру
        $manager_node_klient_db = User::find()
            //->select('id')
            ->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
            ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
            ->orderBy('id desc')
            ->all();

        // Выводим всех блогеров по проекту (нейтральные)
        $bloggers_neutral_projects_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->Where([
                'node_project_blogger.id_project' => Yii::$app->request->get('project'), 
                'node_project_blogger.long_list' => 1, 
                'node_project_blogger.agreed' => 0,
                'node_project_blogger.waiting_creatives' => 0,
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
                'node_project_blogger.waiting_creatives' => 0,
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
                'node_project_blogger.waiting_creatives' => 0,
            ])
            ->orderBy('id desc')
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
                            'Controller' => 'Manager',
                            'Method' => 'Agreed',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $node_project_blogger->id_blogger,
                            'long_list'  => $this->request->post('status_'.$node_project_blogger->id_blogger)
                    );
                                         
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/funnel_manager.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

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
            'manager_node_klient_db'        => $manager_node_klient_db,

            'bloggers_neutral_projects_db'  => $bloggers_neutral_projects_db,
            'bloggers_approved_projects_db' => $bloggers_approved_projects_db,
            'bloggers_rejected_projects_db' => $bloggers_rejected_projects_db,

            'coverage_micro'                => $this->coverage_micro,
            'coverage_average'              => $this->coverage_average
        ]);
    }

    public function actionWork()
    {
        $bloggers_db = BloggerForm::find()->orderBy('id desc')->all();

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

        // Выводим всех блогеров по проекту которые прошли этап загрузки креативов менеджера
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


        // Выводим проекты из таблицы связей для обновлений статусов
        $node_project_blogger_db = NodeProjectBlogger::find()->where(['id_project' => Yii::$app->request->get('project')])->all();

        // Форматы для креативов
        $format_img[0] = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
        $format_video[0] = array('mp4', 'avi', 'MP4', 'AVI');
        

        if ($this->request->isPost)
        {
            // Если модератор нажал кнопку "согласовать" в разделе "Ожидаем отправки креативов"
            if ($this->request->post('btn') == 'to_approve_btn')
            {
                // Изменение бюджета
                $all_used = array();

                foreach ($bloggers_db as $bloggers)
                {
                    // Если отмечена галочка
                    if ($this->request->post('status_waiting_creatives')[$bloggers->id] == 'on')
                    {
                        // Выводим сумму интеграции
                        $data_platforms__integration_cost_db = DataPlatformsForm::find()
                            ->where(['id_blogger' => $bloggers->id])
                            ->all();

                        // Объеденяем цены в один массив
                        $all_used[]=floatval($data_platforms__integration_cost_db[0]->integration_cost);                        
                    }
                }

                // Выводим деньги из проекта
                $projects_db = ProjectForm::find()->Where(['id' => Yii::$app->request->get('project')])->all();

                foreach($projects_db as $projects)
                {
                    $project_reserve = $projects->reserve;
                    $project_used = $projects->used;
                }

                // Складываем все цены прилетевшиеся из post
                foreach($all_used as $used)
                {
                    $summ_all_prices_used += $used;
                }

                // Сумма резерва и израсходованных
                $summ_reserve_used = $project_reserve + $project_used;

                // Складываем использованные средства из БД с новыми
                $summ_all_prices_used = $summ_all_prices_used + $project_used;

                // Вычетаем средства на резерв
                $project_reserve = $summ_reserve_used - $summ_all_prices_used;


                // Обновляем деньги в проекте
                ProjectForm::updateAll(
                [
                    'reserve' => $project_reserve,
                    'used' => $summ_all_prices_used,
                ], 
                [
                    'id' => Yii::$app->request->get('project')
                ]);
                

                // Обработка статусов
                foreach ($node_project_blogger_db as $node_project_blogger)
                {
                    foreach ($this->request->post('status_waiting_creatives') as $key_post_blogger => $id_blogger_post)
                    {
                        // ========================== LOG CREATE ================================= //

                            $str_log = '================================================';

                            $array = array(
                                    'Controller' => 'Manager',
                                    'Method' => 'Work',
                                    'Status' => 'Ожидание отправки креативов',
                                    'id_project' => Yii::$app->request->get('project'),
                                    'id_blogger' => $key_post_blogger,
                            );
                                                 
                            $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                            file_put_contents('../logs/funnel_manager.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                        // ======================== END LOG CREATE =============================== //


                        // Массовое редактирование статусов
                        // BloggerForm::updateAll(['long_list_status_manager' => 0], ['id' => array('11','30','31')]);
                        
                        NodeProjectBlogger::updateAll(
                            ['waiting_creatives' => 1],
                            [
                                'id_project'    => Yii::$app->request->get('project'),
                                'id_blogger'    => $key_post_blogger,  
                                //'id_blogger'  => array('1','2','6')
                            ]);

                            return $this->redirect('/manager/work?project='.Yii::$app->request->get('project'));
                    }
                }
            }
            

            // Обработка креативов ДА
            if ($this->request->post('agreed_id_creative_btn'))
            {
                CreativeForm::updateAll(
                ['status_agreed_klient' => 1],
                [
                    'id'  => $this->request->post('agreed_id_creative_btn'),
                ]);

                return $this->redirect('/manager/work?project='.Yii::$app->request->get('project'));
            }

            // Обработка креативов НЕТ
            if ($this->request->post('rejected_id_creative_btn'))
            {
                CreativeForm::updateAll(
                ['status_agreed_klient' => 2],
                [
                    'id'  => $this->request->post('rejected_id_creative_btn'),
                ]);

                return $this->redirect('/manager/work?project='.Yii::$app->request->get('project'));
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

                return $this->redirect('/manager/work?project='.Yii::$app->request->get('project'));
            }


            // Если модератор нажал кнопку "согласовать" в разделе "креативы на согласовании"
            if ($this->request->post('btn') == 'pending_publication')
            {
                // Обработка статусов
                foreach ($this->request->post('pending_publication') as $key_post_blogger => $id_blogger_post)
                {
                    // ========================== LOG CREATE ================================= //

                        $str_log = '================================================';

                        $array = array(
                            'Controller' => 'Manager',
                            'Method' => 'Work',
                            'Status' => 'Креативы на согласовании',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $key_post_blogger,
                        );
                                                 
                        $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                        file_put_contents('../logs/funnel_manager.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                    // ======================== END LOG CREATE =============================== //

                    // Массовое редактирование статусов
                    // BloggerForm::updateAll(['long_list_status_manager' => 0], ['id' => array('11','30','31')]);
    
                    NodeProjectBlogger::updateAll(
                        ['agreed_creative' => 1],
                        [
                            'id_project'    => Yii::$app->request->get('project'),
                            'id_blogger'    => $key_post_blogger,
                            //'id_blogger'  => array('1','2','6')
                        ]);
                }
            }


            // Если модератор нажал кнопку "согласовать" в разделе "Ожидает публикации"
            if ($this->request->post('btn') == 'publication_confirmation')
            {
                // Обработка статусов
                foreach ($this->request->post('publication_confirmation') as $key_post_blogger => $id_blogger_post)
                {
                    // ========================== LOG CREATE ================================= //

                        $str_log = '================================================';

                        $array = array(
                            'Controller' => 'Manager',
                            'Method' => 'Work',
                            'Status' => 'Ожидает публикации',
                            'id_project' => Yii::$app->request->get('project'),
                            'id_blogger' => $key_post_blogger,
                        );
                                                 
                        $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                        file_put_contents('../logs/funnel_manager.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                    // ======================== END LOG CREATE =============================== //
                
                    // Массовое редактирование статусов
                    // BloggerForm::updateAll(['long_list_status_manager' => 0], ['id' => array('11','30','31')]);
    
                    NodeProjectBlogger::updateAll(
                        ['confirmed' => 1],
                        [
                            'id_project'    => Yii::$app->request->get('project'),
                            'id_blogger'    => $key_post_blogger,
                            //'id_blogger'  => array('1','2','6')
                        ]);

                    // **** Закидываем бабки в использованные **** //

                        // Выводим данные платформы блогеров для модуля денег
                        $data_platforms_db = DataPlatformsForm::find()->Where(['id_blogger' => $key_post_blogger])->all();

                        // выводим цену интеграции
                        foreach ($data_platforms_db as $data_platforms)
                        {
                            // обновим бабки на резерве (сейчас не суммируются все значения, работают по 1)
                            ProjectForm::updateAll(
                            [
                                'used' => $project_reserve + $data_platforms->integration_cost
                            ], 
                            [
                                'id'    => Yii::$app->request->get('project')
                            ]);
                        }

                    // **** END Закидываем бабки в использованные **** //
                }
            }

            return $this->redirect(['manager/work?project='.Yii::$app->request->get('project')]);
        }

        

        return $this->render('work', [
            // 'bloggers_work_db'  => $bloggers_work_db,
            // 'bloggers_status_agreed_db'       => $bloggers_status_agreed_db

            'creative_db' => $creative_db,
            'bloggers_waiting_creatives_db' => $bloggers_waiting_creatives_db,
            'node_project_blogger_db' => $node_project_blogger_db,
            'bloggers_agreed_creative_db' => $bloggers_agreed_creative_db,
            'bloggers_pending_publication_db' => $bloggers_pending_publication_db,
            'bloggers_confirmed_db' => $bloggers_confirmed_db,
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
            
            if($entry == 'klients_all')
            {
                $users = User::find()
                    ->leftJoin('node_klient_manager', '`node_klient_manager`.`id_klient` = `user`.`id`')
                    ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id])
                    ->orderBy('id desc')
                    ->limit($per_page)
                    ->offset($off)
                    ->all();
            }

            if($entry == 'klients_in_work')
            {
                $users = User::find()
                    ->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
                    ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id, 'user.role' => ['klient']])
                    ->where(['>','node_klient_manager.id_project', 0])
                    ->orderBy('id desc')
                    ->limit($per_page)
                    ->offset($off)
                    ->all();
            }

            if($entry == 'klients_no_project')
            {
                $users = User::find()
                    ->leftJoin('node_project_klient','`node_project_klient`.`id_klient` = `user`.`id`')
                    ->leftJoin('node_klient_manager','`node_klient_manager`.`id_klient` = `user`.`id`')
                    ->where(['node_klient_manager.id_manager' => Yii::$app->user->identity->id, 'node_klient_manager.id_project' => 0])
                    ->orderBy('id desc')
                    ->limit($per_page)
                    ->offset($off)
                    ->all();
            }

            
            $data = array(
                'its' => $users,
            );  
            return  $this->renderPartial('ajax/'.$entry, array(
                'data'=>$data,
            ));            
    }
}
