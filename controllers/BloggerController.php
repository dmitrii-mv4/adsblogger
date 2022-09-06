<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\NotFoundHttpException; // 404
use yii\web\HttpException; // 403

use app\models\BloggerForm;
use app\models\BloggerSearch;
use app\models\PlatformForm;
use app\models\User;
use app\models\DataPlatformsForm;
use app\models\CategoryForm;

use app\models\Customer;
use app\models\Order;

use app\models\ProjectForm;

use app\models\node\NodeManagerBlogger;
use app\models\node\NodeKlientBlogger;
use app\models\node\NodeProjectBlogger;
use app\models\node\NodeKlientManager;
use app\models\node\NodeProjectKlient;
use app\models\node\NodeProjectManager;

/**
 * BloggerController implements the CRUD actions for BloggerForm model.
 */
class BloggerController extends Controller
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
     * Lists all BloggerForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BloggerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BloggerForm model.
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
     * Creates a new BloggerForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $bloggers_model = new BloggerForm();
        $data_platforms_model = new DataPlatformsForm();

        $platforms_db = PlatformForm::find()->all();
        $users_manager_db = User::find()->where(['role' => ['manager']])->all();
        $categories_db = CategoryForm::find()->all();

        if ($this->request->isPost)
        {
            // Если не выбрана категория
            if ($this->request->post('id_category') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Blogger | Method: Create | Категория не выбрана';
                file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);

                Yii::$app->getSession()->setFlash('empty_category', 'Выберите категорию.');
                return $this->redirect('create');
                die;
            }

            $bloggers_model->create_date = date("Y-m-d H:i:s"); // дата добавления
            $bloggers_model->create_user_id = Yii::$app->user->identity->id; // пользователь который добавил
            $bloggers_model->id_category = $this->request->post('id_category');

            // Добавление блогера
            if ($bloggers_model->load($this->request->post()) && $bloggers_model->save())
            {
                // загрузка доп данных для платформ
                foreach ($platforms_db as $platform) 
                {
                    $model_data_platforms [$platform['id']] = new DataPlatformsForm();

                    // Заносим в БД только те платформы укоторых объявленно поле url
                    if (!empty($this->request->post('url_'.$platform['id'])))
                    {
                        $model_data_platforms [$platform['id']]->url = $this->request->post('url_'.$platform['id']);
                        $model_data_platforms [$platform['id']]->id_platform = $this->request->post('platform_id_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->subscribers = $this->request->post('subscribers_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->coverage = $this->request->post('coverage_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->integration_cost = $this->request->post('integration_cost_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->audience_gender = $this->request->post('audience_gender_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->involvement = $this->request->post('involvement_'.$this->request->post('platform_id_'.$platform['id']));
                        $model_data_platforms [$platform['id']]->involvement_promotional_post = $this->request->post('involvement_promotional_post_'.$this->request->post('platform_id_'.$platform['id']));

                        $model_data_platforms [$platform['id']]->create_user_id = Yii::$app->user->identity->id; // пользователь который добавил
                        $model_data_platforms [$platform['id']]->create_date = date("Y-m-d H:i:s"); // дата добавления
                        $model_data_platforms [$platform['id']]->id_blogger = $bloggers_model->id; // id блогера
                        $model_data_platforms [$platform['id']]->save();
                    }
                }

                // добавляем нескольких ответственных менеджеров
                //foreach ($this->request->post('responsible_manager') as $responsible_manager_post)
                //{
                    // define code
                    // Yii::$app->db->createCommand()->batchInsert('users', ['name', 'age'], [
                    //     ['Tom', 30],
                    //     ['Jane', 20],
                    //     ['Linda', 25],
                    // ])->execute();

                    //Yii::$app->db->createCommand()->batchInsert('table_links', ['id_manager', 'id_blogger'], [
                        //[$responsible_manager_post, $bloggers_model->id],
                    //])->execute();
                //}

                return $this->redirect(['view', 'id' => $bloggers_model->id]);
            } else {
                $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Create | Не все обязательные поля были заполнены';
                file_put_contents('../logs/bloggers.txt', PHP_EOL . $log . PHP_EOL, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_post', 'Нужно заполнить все обязательные поля.');
                return $this->redirect('create');
                die;
            }

        } else {
            $bloggers_model->loadDefaultValues();
        }

        return $this->render('create', [
            'bloggers_model'    => $bloggers_model,
            'platforms_db'      => $platforms_db,
            'users_manager_db'  => $users_manager_db,
            'categories_db'     => $categories_db,
        ]);
    }

    /**
     * Updates an existing BloggerForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // Данные одного блогера
        $bloggers_one_model = $this->findModel($id);

        // Вывод данных
        $platforms_db = PlatformForm::find()->all();
        $managers_db = User::find()->where(['role' => ['manager']])->all();
        $klients_db = User::find()->where(['role' => ['klient']])->all();
        $data_platforms_db = DataPlatformsForm::find()->where(['id_blogger' => $id])->all();
        $category_db = CategoryForm::find()->all();
        $projects_db = ProjectForm::find()->all();
        $node_project_manager_db = NodeProjectManager::find()->all();

        // Выводим всех привязанных менеджеров + цепляем их username
        $managers_node_db = User::find()
            ->leftJoin('node_manager_blogger', '`node_manager_blogger`.`id_manager` = `user`.`id`')
            ->where(['node_manager_blogger.id_blogger' => $id])
            ->all();

        // Выводим всех привязанных клиентов + цепляем их username
        $klients_node_db = User::find()
            ->leftJoin('node_klient_blogger', '`node_klient_blogger`.`id_klient` = `user`.`id`')
            ->where(['node_klient_blogger.id_blogger' => $id])
            ->all();

        // Выводим все привязанные проекты + цепляем их title
        $projects_node_db = ProjectForm::find()
            ->leftJoin('node_project_blogger', '`node_project_blogger`.`id_project` = `projects`.`id`')
            ->where(['node_project_blogger.id_blogger' => $id])
            ->all();

        // Связки
        $node_klient_manager = new NodeKlientManager();


        // Проверяем, если нажата кнопка "Сохранить"
        if ($this->request->isPost)
        {
            // ========================== LOGS UPDATE ================================= //

            // LONG NONE UPDATE //

                $str_log = '================================================';

                    $array = array(
                        'Controller' => 'Blogger',
                        'Method' => 'Update',
                        'id_blogger' => $bloggers_one_model->id,
                        'update_id_managers_on' => $this->request->post('id_managers'),
                        'update_id_klients_on' => $this->request->post('id_klients'),
                        'update_id_projects_on' => $this->request->post('id_projects'),
                    );
                             
                    $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                    file_put_contents('../logs/bloggers.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                // END LONG NONE UPDATE //

            // ======================== END LOGS UPDATE =============================== //

            // Если не выбрана категория
            if ($this->request->post('id_category') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Blogger | Method: Update | Категория не выбрана';
                file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);

                Yii::$app->getSession()->setFlash('error_category', 'Выберите категорию.');
                return $this->redirect('create');
                die;
            }
            
            // Загрузка доп данных для платформ

            // foreach ($platforms_db as $platform) 
            // {
            //     if (!empty($this->request->post('url_'.$platform['id'])))
            //     {
            //         // где меняем
            //         $where_update = [
            //             'id_platform' => $this->request->post('platform_id_'.$platform['id']),
            //             'id_blogger' => $id,
            //         ];

            //         // что меняем
            //         $data_platforms_update = [
            //             'url' => $this->request->post('url_'.$platform['id']),
            //             'subscribers' => $this->request->post('subscribers_'.$platform['id']),
            //             'coverage' => $this->request->post('coverage_'.$platform['id']),
            //             'integration_cost' => $this->request->post('integration_cost_'.$platform['id']),
            //             'cpm' => $this->request->post('cpm_'.$platform['id']),
            //             'cpv' => $this->request->post('cpv_'.$platform['id']),
            //             'audience_gender' => $this->request->post('audience_gender_'.$platform['id']),
            //             'involvement' => $this->request->post('involvement_'.$platform['id']),
            //             'involvement_promotional_post' => $this->request->post('involvement_promotional_post_'.$platform['id']),
                        
            //             'update_user_id' => Yii::$app->user->identity->id, // пользователь который редактировал
            //             'update_date' => date("Y-m-d H:i:s"), // дата редактирования
            //         ];

            //         DataPlatformsForm::updateAll($data_platforms_update, $where_update);
            //     }
            // }

            $bloggers_one_model->id_category = $this->request->post('id_category'); // категория
            $bloggers_one_model->update_date = date("Y-m-d H:i:s"); // дата редактирования
            $bloggers_one_model->update_user_id = Yii::$app->user->identity->id; // пользователь который редактировал


            // Проверим поступили ли изменения в форме
            if ($bloggers_one_model->load($this->request->post()) && $bloggers_one_model->save()) 
            {
            /// =========================== Node Manager Blogger ===================================== ///

                // Если поступили данные с post id_managers
                if(!empty($this->request->post('id_managers')))
                {
                    // Если проекты есть, то удалим все записи
                    if(!empty($this->request->post('id_projects')))
                    {
                        NodeManagerBlogger::deleteAll(['id_blogger' => $id]);
                    }

                    // Создаём связь с платформой и блогерами
                    foreach ($this->request->post('id_managers') as $id_managers_post)
                    {
                        // Если поступили данные с post id_projects
                        if(!empty($this->request->post('id_projects')))
                        {
                            foreach ($this->request->post('id_projects') as $id_projects_post)
                            {
                                Yii::$app->db->createCommand()->batchInsert('node_manager_blogger', ['id_project', 'id_manager', 'id_blogger'], [
                                    [$id_projects_post, $id_managers_post, $id],
                                ])->execute();
                            }

                        } else {
                            $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Update | Node: NodeManagerBlogger | Не выбраны проекты';
                            file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);
                        }
                    }

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Update | Node: NodeManagerBlogger | Не выбраны менеджеры';
                    file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);
                } // end post id_managers

                
                /// =========================== NodeKlientBlogger ===================================== ///

                // Если поступили данные с post id_klients
                if(!empty($this->request->post('id_klients')))
                {
                    // Если проекты есть, то удалим все записи
                    if(!empty($this->request->post('id_projects')))
                    {
                        NodeKlientBlogger::deleteAll(['id_blogger' => $id]);
                    }

                    // Создаём связь с платформой и блогерами
                    foreach ($this->request->post('id_klients') as $id_klients_post)
                    {
                        // Если поступили данные с post id_projects
                        if(!empty($this->request->post('id_projects')))
                        {
                            foreach ($this->request->post('id_projects') as $id_projects_post)
                            {
                                Yii::$app->db->createCommand()->batchInsert('node_klient_blogger', ['id_project', 'id_klient', 'id_blogger'], [
                                    [$id_projects_post, $id_klients_post, $id],
                                ])->execute();
                            }

                        } else {
                            $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Update | Node: NodeKlientBlogger | Пустая связь: блогер - проект';
                            file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);
                        }
                    }

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Update | Node: NodeKlientBlogger | Пустая связь: блогер - клиент';
                    file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);
                } // end post id_klients


                /// =========================== NodeProjectBlogger ===================================== ///

                // Если поступили данные с post id_projects
                if(!empty($this->request->post('id_projects')))
                {
                    NodeProjectBlogger::deleteAll(['id_blogger' => $id]);

                    foreach ($this->request->post('id_projects') as $id_projects_post)
                    {
                        Yii::$app->db->createCommand()->batchInsert('node_project_blogger', ['id_project', 'id_blogger'], [
                            [$id_projects_post, $id],
                        ])->execute();
                    }

                } else {
                    $log = date('Y-m-d H:i:s') . ' Controller: Blogger | Method: Update | Node: NodeProjectBlogger | Пустая связь: блогер - проект';
                    file_put_contents('../logs/bloggers.txt', PHP_EOL . $log, FILE_APPEND);
                }


                return $this->redirect(['view', 'id' => $bloggers_one_model->id]);
            }

        } else {
            $bloggers_one_model->loadDefaultValues();
        }

        return $this->render('update', [
            'bloggers_one_model'      => $bloggers_one_model,
            'platforms_db'            => $platforms_db,
            'managers_db'             => $managers_db,
            'klients_db'              => $klients_db,
            'data_platforms_db'       => $data_platforms_db,
            'table_links_db'          => $table_links_db,
            'category_db'             => $category_db,
            'manager_attached_db'     => $manager_attached_db,
            'klient_attached_db'      => $klient_attached_db,

            'managers_node_db'        => $managers_node_db,
            'klients_node_db'         => $klients_node_db,
            'projects_node_db'        => $projects_node_db,
            'projects_db'             => $projects_db,
        ]);
    }

    /**
     * Deletes an existing BloggerForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // удаление доп инфы по площадкам        
        DataPlatformsForm::deleteAll(['id_blogger' => $id]);

        return $this->redirect(['/']);
    }

    /**
     * Finds the BloggerForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return BloggerForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($bloggers_model = BloggerForm::findOne(['id' => $id])) !== null) {
            return $bloggers_model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
