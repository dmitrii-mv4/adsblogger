<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\NotFoundHttpException; // 404
use yii\web\HttpException; // 403

use app\models\ProjectForm;
use app\models\ProjectSearch;
use app\models\PlatformForm;
use app\models\User;
use app\models\ProjectsPlatformsForm;
use app\models\BloggerForm;

use app\models\node\NodeProjectPlatform;
use app\models\node\NodeProjectManager;
use app\models\node\NodeProjectKlient;
use app\models\node\NodeProjectBlogger;
use app\models\node\NodeKlientBlogger;
use app\models\node\NodeKlientManager;
use app\models\node\NodeManagerBlogger;


/**
 * ProjectController implements the CRUD actions for ProjectForm model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */

    public $layout;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'], // действия в контроллере
                'rules' => [ // правила к действиям
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'], // действия в контроллере
                        'roles' => ['@'],
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
                                    return false;
                                    break;
                                
                                default:
                                    throw new HttpException(403/*or any code*/, 'Forbidden'/*or any message*/);
                                    break;
                            }
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

        $this->layout = 'manager';
    }

    /**
     * Lists all ProjectForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectForm model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProjectForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $projects_model = new ProjectForm();
        $projects_platforms_model = new ProjectsPlatformsForm();
        
        // Таблицы связей
        $node_project_platform = new NodeProjectPlatform();
        $node_project_manager = new NodeProjectManager();
        $node_project_klient = new NodeProjectKlient();
        $node_project_blogger = new NodeProjectBlogger();
        $node_klient_manager = new NodeKlientManager();
        $node_klient_blogger = new NodeKlientBlogger();

        // Вывод данных из БД
        $platforms_db = PlatformForm::find()->all();
        $users_manager_db = User::find()->where(['role' => ['manager']])->all();
        $users_klient_db = User::find()->where(['role' => ['klient']])->all();
        $bloggers_db = BloggerForm::find()->all();
        $node_klient_manager_db = NodeKlientManager::find()->all();
        

        // Если нажата кнопка "Создать"
        if ($this->request->isPost)
        {
            if ($this->request->post('id_platform') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Project | Method: Create | Node: node_project_manager | Платформа не выбрана';
                file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_platform', 'Выберите платформу.');
                return $this->redirect('create');
                die;
            }

            if ($this->request->post('id_manager') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Project | Method: Create | Node: node_project_manager | Менеджер не выбран';
                file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_manager', 'Выберите ответственного менеджера.');
                return $this->redirect('create');
                die;
            }

            if ($this->request->post('id_klient') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Project | Method: Create | Node: node_project_manager | Клиент не выбран';
                file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_klient', 'Выберите ответственного менеджера.');
                return $this->redirect('create');
                die;
            }

            // Обрабатываем и сохраняем данные
            if ($projects_model->load($this->request->post()) && $projects_model->save()) 
            {
                // ========================== LOG CREATE ================================= //

                    $str_log = '================================================';

                    $array = array(
                        'Controller' => 'Project',
                        'Method' => 'Create',
                        'id_project' => $projects_model->id,
                        'create_id_platform_on' => $this->request->post('id_platform'), 
                        'create_id_manager_on' => $this->request->post('id_manager'), 
                        'create_id_klient_on' => $this->request->post('id_klient'), 
                        'create_id_bloggers_on' => $this->request->post('id_bloggers')
                    );
                                 
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/projects.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                // ======================== END LOG CREATE =============================== //


                /// =========================== Node Project Platform ===================================== ///
                if ($this->request->post('id_platform') != 0)
                {
                    // Сохраняем привязки в таблицу -> node_project_platform
                    $node_project_platform->id_platform = $this->request->post('id_platform'); // привязка к платформе
                    $node_project_platform->id_project = $projects_model->id; // привязка к проекту
                    $node_project_platform->save();

                    // Если отправка данных не прошла
                    if (!$node_project_platform->save())
                    {
                        $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_project_platform | Ошибка в отправке запроса:';
                        file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                        throw new HttpException(500, 'Ошибка запроса!');
                    }
                }


                /// =========================== Node Project Manager ===================================== ///
                if ($this->request->post('id_manager') != 0)
                {
                    // Сохраняем привязки в таблицу -> node_project_manager
                    $node_project_manager->id_manager = $this->request->post('id_manager'); // привязка к платформе
                    $node_project_manager->id_project = $projects_model->id; // привязка к проекту
                    $node_project_manager->save();

                    // Если отправка данных не прошла
                    if (!$node_project_manager->save())
                    {
                        // Отправляем в лонг
                        $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_project_manager | Нажата кнопка, но post запрос пришёл пустой';
                        file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                        throw new HttpException(500, 'Ошибка запроса!');
                    }

                } else {

                    // Отправляем в лонг
                    $log = date('Y-m-d H:i:s') . ' | Controller: Project | Method: Create | Node: node_project_manager | Менеджер не выбран, но проект создан';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                /// =========================== Node Project Klient ===================================== ///
                if ($this->request->post('id_klient') != 0)
                {
                    // Сохраняем привязки в таблицу -> node_project_klient
                    $node_project_klient->id_klient = $this->request->post('id_klient'); // привязка к платформе
                    $node_project_klient->id_project = $projects_model->id; // привязка к проекту
                    $node_project_klient->save();

                    // Если отправка данных не прошла
                    if (!$node_project_klient->save())
                    {
                        $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_project_klient | Нажата кнопка, но post запрос пришёл пустой';
                        file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                        throw new HttpException(500, 'Ошибка запроса!');
                    }

                } else {

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Клиент не выбран, но проект создан';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                /// =========================== Node Klient Manager ===================================== ///
                if ($this->request->post('id_klient') != 0 && $this->request->post('id_manager') != 0)
                {
                    $node_klient_manager->id_klient = $this->request->post('id_klient');
                    $node_klient_manager->id_manager = $this->request->post('id_manager');
                    $node_klient_manager->id_project = $projects_model->id;
                    $node_klient_manager->save();

                    // Если отправка данных не прошла
                    if (!$node_klient_manager->save())
                    {
                        $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_klient_manager | Нажата кнопка, но post запрос пришёл пустой';
                        file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                        throw new HttpException(500, 'Ошибка запроса!');
                    }

                } else {

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_klient_manager | Клиент или менеджер не выбран';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                /// =========================== Node Project Blogger ===================================== ///
                if ($this->request->post('id_bloggers'))
                {
                    $bloggers_post = $this->request->post('id_bloggers');

                    // Добавляем блогеров в связку -> node_project_blogger
                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_project_blogger', ['id_project', 'id_blogger'], [
                            [$projects_model->id, $bloggers_post],
                        ])->execute();
                    }
                
                    // Добавляем клиентов в связку -> node_klient_blogger
                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_klient_blogger', ['id_project', 'id_klient', 'id_blogger'], [
                            [$projects_model->id, $this->request->post('id_klient'), $bloggers_post],
                        ])->execute();
                    }

                    // Добавляем клиентов в связку -> node_manager_blogger
                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_manager_blogger', ['id_project', 'id_manager', 'id_blogger'], [
                            [$projects_model->id, $this->request->post('id_manager'), $bloggers_post],
                        ])->execute();
                    }

                } else {

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Node: node_manager_blogger | Блогеры не выбраны';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }

                // Добавляем прочие данные
                $projects_model->create_date = date("Y-m-d H:i:s"); // дата добавления
                $projects_model->create_user_id = Yii::$app->user->identity->id; // пользователь который добавил
                $projects_model->balance = $projects_model->budget;
                $projects_model->save();
                
                return $this->redirect(['view', 'id' => $projects_model->id]);

            } else {
                $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Create | Не все обязательные поля были заполнены';
                file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_post', 'Нужно заполнить все обязательные поля.');
                return $this->redirect('create');
                die;
            }

        } else {
            $projects_model->loadDefaultValues();
        }

        return $this->render('create', [
            'projects_model'    => $projects_model,
            'users_klient_db'   => $users_klient_db,
            'platforms_db'      => $platforms_db,
            'users_manager_db'  => $users_manager_db,
            'bloggers_db'       => $bloggers_db,
        ]);
    }

    /**
     * Updates an existing ProjectForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $projects_model = $this->findModel($id);

        // Связки
        $node_klient_manager = new NodeKlientManager();
        $node_klient_blogger = new NodeKlientBlogger();
        $node_manager_blogger = new NodeManagerBlogger();

        $users_klient_db = User::find()->where(['role' => ['klient']])->all();

        // Выводим все данные из БД
        $platforms_db = PlatformForm::find()->all();
        $managers_db = User::find()->where(['role' => ['manager']])->all();
        $bloggers_db = BloggerForm::find()->all();

        // Выводим все привязанные платформы + цепляем их title
        $platforms_node_db = PlatformForm::find()
            ->leftJoin('node_project_platform', '`node_project_platform`.`id_platform` = `platforms`.`id`')
            ->where(['node_project_platform.id_project' => $id])
            ->all();

        // Выводим всех привязанных менеджеров + цепляем их username
        $managers_node_db = User::find()
            ->leftJoin('node_project_manager', '`node_project_manager`.`id_manager` = `user`.`id`')
            ->where(['node_project_manager.id_project' => $id])
            ->all();

        // Выводим всех привязанных клиентов + цепляем их username
        $klients_node_db = User::find()
            ->leftJoin('node_project_klient', '`node_project_klient`.`id_klient` = `user`.`id`')
            ->where(['node_project_klient.id_project' => $id])
            ->all();

        // Выводим всех привязанных блогеров + цепляем их имена
        $bloggers_node_db = BloggerForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_blogger` = `bloggers`.`id`')
            ->where(['node_project_blogger.id_project' => $id])
            ->all();

        
        // Проверяем, если нажата кнопка "Сохранить"
        if ($this->request->isPost)
        {
            // ========================== LOG UPDATE ================================= //

                $str_log = '================================================';

                $array = array(
                    'Controller' => 'Project',
                    'Method' => 'Update',
                    'id_project' => $projects_model->id,
                    'updated_id_platform_on' => $this->request->post('id_platform'), 
                    'updated_id_manager_on' => $this->request->post('id_manager'), 
                    'updated_id_klient_on' => $this->request->post('id_klient'), 
                    'updated_id_bloggers_on' => $this->request->post('id_bloggers')
                );
                             
                $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                file_put_contents('../logs/projects.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

            // ======================== END LOG UPDATE =============================== //


            $projects_model->update_date = date("Y-m-d H:i:s"); // дата редактирования
            $projects_model->update_user_id = Yii::$app->user->identity->id; // пользователь который редактировал
            //$projects_model->balance = $projects_model->budget;
            

            if ($projects_model->load($this->request->post()) && $projects_model->save())
            {
                // Обновляем связь с платформой и проектом
                if ($this->request->post('id_platform'))
                {
                    $node_project_platform_db = NodeProjectPlatform::find()->where(['id_project' => $id])->all();

                    // Если есть в БД запись с id от проекта
                    if ($node_project_platform_db)
                    {
                        // где меняем
                        $where_update_project = [
                            'id_project' => $id,
                        ];

                        // что меняем
                        $node_platform_update = [
                            'id_platform'  => $this->request->post('id_platform'),
                        ];

                        NodeProjectPlatform::updateAll($node_platform_update, $where_update_project);

                    } else {

                        Yii::$app->db->createCommand()->batchInsert('node_project_platform', ['id_project', 'id_platform'], [
                            [$id, $this->request->post('id_platform')],
                        ])->execute();

                        $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_project_platform | В БД не найдена запись с данной связкой и поэтому система создала её';
                        file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                    }

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_project_platform | Не выбрана платформа';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                // Обновляем связь с менеджером и проектом
                if ($this->request->post('id_manager'))
                {
                    // где меняем
                    $where_update_project = [
                        'id_project' => $id,
                    ];

                    // что меняем
                    $node_manager_update = [
                        'id_manager'  => $this->request->post('id_manager'),
                    ];

                    NodeProjectManager::updateAll($node_manager_update, $where_update_project);

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_project_manager | Не выбран менеджер';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                // Обновляем связь с клиентом и проектом
                if ($this->request->post('id_klient'))
                {
                    // где меняем
                    $where_update_project = [
                        'id_project' => $id,
                    ];

                    // что меняем
                    $node_klient_update = [
                        'id_klient'  => $this->request->post('id_klient'),
                    ];

                    NodeProjectKlient::updateAll($node_klient_update, $where_update_project);

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_project_klient | Не выбран клиент';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }


                // Обновляем связь с блогеров и проектом
                if ($this->request->post('id_bloggers'))
                {
                    // Удаляем все записи по данному проету
                    NodeProjectBlogger::deleteAll(['id_project' => $id]);

                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_project_blogger', ['id_project', 'id_blogger'], [
                            [$projects_model->id, $bloggers_post],
                        ])->execute();
                    }

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_project_blogger | Все блогеры были удалены и заново добавлены - это временное решение. Нужно будет обдумать как их не удалять, а редактировать.';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);
                }

                // Если поступили id менеджеров и id клиента
                if ($this->request->post('id_manager') && $this->request->post('id_klient'))
                {
                    // Удаляем все записи по данному проету
                    NodeKlientManager::deleteAll(['id_project' => $id]);

                    $node_klient_manager->id_manager = $this->request->post('id_manager');
                    $node_klient_manager->id_klient = $this->request->post('id_klient');
                    $node_klient_manager->id_project = $id;
                    $node_klient_manager->save();

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_klient_manager | Все связки менеджер и клиент с данным проектом были удалены и заново добавлены - это временное решение. Нужно будет обдумать как их не удалять, а редактировать.';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_klient_manager | Не выбраны менеджер или клиент';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }

                // Если поступили id блоггеров и id клиента
                if ($this->request->post('id_bloggers') && $this->request->post('id_klient'))
                {
                    // Удаляем все записи по данному проету
                    NodeKlientBlogger::deleteAll(['id_project' => $id]);

                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_klient_blogger', ['id_project', 'id_klient', 'id_blogger'], [
                            [$id, $this->request->post('id_klient'), $bloggers_post],
                        ])->execute();
                    }

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_klient_blogger | Все связки блогер и клиент с данным проектом были удалены и заново добавлены - это временное решение. Нужно будет обдумать как их не удалять, а редактировать.';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_klient_blogger | Не выбраны блогеры или клиент';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }

                // Если поступили id блоггеров и id менеджера
                if ($this->request->post('id_bloggers') && $this->request->post('id_manager'))
                {
                    // Удаляем все записи по данному проету
                    NodeManagerBlogger::deleteAll(['id_project' => $id]);

                    // Добавляем клиентов в связку -> node_manager_blogger
                    foreach ($this->request->post('id_bloggers') as $bloggers_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_manager_blogger', ['id_project', 'id_manager', 'id_blogger'], [
                            [$projects_model->id, $this->request->post('id_manager'), $bloggers_post],
                        ])->execute();
                    }

                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_manager_blogger | Все связки блогер и менеджер с данным проектом были удалены и заново добавлены - это временное решение. Нужно будет обдумать как их не удалять, а редактировать.';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Project | Method: Update | Node: node_manager_blogger | Не выбраны блогеры или менеджер';
                    file_put_contents('../logs/projects.txt', PHP_EOL . $log, FILE_APPEND);
                }
            }

            return $this->redirect(['view', 'id' => $projects_model->id]);

        } else {
            $projects_model->loadDefaultValues();
        }

        return $this->render('update', [
            'projects_model'                 => $projects_model,
            'users_klient_db'                => $users_klient_db,
            'responsible_manager_id'         => $responsible_manager_id,
            'responsible_manager_username'   => $responsible_manager_username,
            'klient_id'                      => $klient_id,
            'klient_username'                => $klient_username,
            'project_platforms_db'           => $project_platforms_db,
            'platform_id'                    => $platform_id,
            'platform_title'                 => $platform_title,

            'platforms_db'                   => $platforms_db,
            'platforms_node_db'              => $platforms_node_db,
            'managers_node_db'               => $managers_node_db,
            'managers_db'                    => $managers_db,
            'klients_node_db'                => $klients_node_db,
            'bloggers_db'                    => $bloggers_db,
            'bloggers_node_db'               => $bloggers_node_db,
        ]);
    }

    /**
     * Deletes an existing ProjectForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        NodeKlientBlogger::deleteAll(['id_project' => $id]);
        NodeKlientManager::deleteAll(['id_project' => $id]);
        NodeManagerBlogger::deleteAll(['id_project' => $id]);
        NodeProjectBlogger::deleteAll(['id_project' => $id]);
        NodeProjectKlient::deleteAll(['id_project' => $id]);
        NodeProjectManager::deleteAll(['id_project' => $id]);
        NodeProjectPlatform::deleteAll(['id_project' => $id]);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return ProjectForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($projects_model = ProjectForm::findOne(['id' => $id])) !== null) {
            return $projects_model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
