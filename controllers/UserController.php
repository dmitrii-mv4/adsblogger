<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\NotFoundHttpException; // 404
use yii\web\HttpException; // 403

use app\models\UserForm;
use app\models\UserSearch;
use app\models\User;
use app\models\BloggerForm;
use app\models\ProjectForm;

use app\models\node\NodeKlientManager;
use app\models\node\NodeProjectKlient;
use app\models\node\NodeKlientBlogger;

/**
 * UserController implements the CRUD actions for UserForm model.
 */
class UserController extends Controller
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
                                    throw new HttpException(403, 'Вам не разрешено этого делать');
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
     * Lists all UserForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = User::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single UserForm model.
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
     * Creates a new UserForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $managers_db = User::find()->where(['role' => ['manager']])->all();
        $bloggers_db = BloggerForm::find()->all();
        $projekts_db = ProjectForm::find()->all();
   

        if ($this->request->isPost) {

            // echo "<pre>";
            //     var_dump($this->request->post('password'));
            // echo "</pre>";

            // die;

            if (Yii::$app->request->get('type') == 'klient')
            {
                // если пароли совпадают
                if ($this->request->post('password') == $this->request->post('password_repeat'))
                {
                    $model->signup_date = date("Y-m-d H:i:s");
                    $model->create_user_id = Yii::$app->user->identity->id;
                    $model->role = 'klient'; // роль пользователя
                    $model->password = Yii::$app->security->generatePasswordHash($this->request->post('password'));

                } else {
                    Yii::$app->getSession()->setFlash('error_password', 'Пароли не совпадают!');
                    return $this->redirect('create?type=manager');
                    die;
                }
                
            } else {

                // если пароли совпадают
                if ($this->request->post('password') == $this->request->post('password_repeat'))
                {

                    // echo "<pre>";
                    //     var_dump($this->request->post());
                    // echo "</pre>";

                

                    // $username_db = User::find()
                    //     ->select('username')
                    //     ->where(['username' => 'Yura@mail.ru'])
                    //     ->all();

                    // echo "<pre>";
                    //     var_dump($username_db);
                    // echo "</pre>";

                    // die;    



                    $model->signup_date = date("Y-m-d H:i:s"); // дата добавления
                    $model->create_user_id = Yii::$app->user->identity->id;
                    $model->role = 'manager'; // роль пользователя
                    $model->password = Yii::$app->security->generatePasswordHash($this->request->post('password'));

                } else {
                    Yii::$app->getSession()->setFlash('error_password', 'Пароли не совпадают!');
                    return $this->redirect('create?type=manager');
                    die;
                }
            }

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        // выбираем какой тип пользователя создаём
        switch (Yii::$app->request->get('type')) {
            case 'manager':
                return $this->render('create/manager', [
                    'model' => $model,
                ]);
                break;

            case 'klient':
                return $this->render('create/klient', [
                    'model' => $model,
                    'managers_db'           => $managers_db,
                    'bloggers_db'           => $bloggers_db,
                    'projekts_db'           => $projekts_db,
                ]);
                break;
            
            default:
                
                // Если не админ, то сливаем на страницу create/klient
                if (Yii::$app->user->identity->role != 'admin')
                {
                    return \Yii::$app->getResponse()->redirect('?type=klient');
                } else {

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                break;
        }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing UserForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // Выводим всех клиентов
        $klients_db = User::find()
            ->select('id')
            ->where(['role' => ['klient'], 'id' => $id])
            ->all();


        if (Yii::$app->user->identity->role == 'manager')
        {
            if ($klients_db == true)
            {
                $access_update = true;

            } else {
                throw new HttpException(403, 'Вам не разрешено этого делать');
            }
        }

        if (Yii::$app->user->identity->role == 'admin')
        {
            $access_update = true;
        }

        // Если доступ разрешён
        if ($access_update == true)
        {
            $model = $this->findModel($id);
            $managers_db = User::find()->where(['role' => ['manager']])->all();
            $projekts_db = ProjectForm::find()->all();
            $bloggers_db = BloggerForm::find()->all();

            // Выводим всех привязанных менеджеров + цепляем их username
            $managers_node_db = User::find()
                ->leftJoin('node_klient_manager', '`node_klient_manager`.`id_manager` = `user`.`id`')
                ->where(['node_klient_manager.id_klient' => $id])
                ->all();

            $projects_node_db = ProjectForm::find()
                ->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `projects`.`id`')
                ->where(['node_project_klient.id_klient' => $id])
                ->all();

            $bloggers_node_db = BloggerForm::find()
                ->leftJoin('node_klient_blogger', '`node_klient_blogger`.`id_blogger` = `bloggers`.`id`')
                ->where(['node_klient_blogger.id_klient' => $id])
                ->all();



            if ($model->role == 'admin') {
                throw new HttpException(403, 'Вам не разрешено этого делать');
            }

            if ($this->request->isPost)
            {
                // ========================== LOGS UPDATE ================================= //

                    // LONG NONE UPDATE //

                        $str_log = '================================================';

                        $array = array(
                            'Controller' => 'User',
                            'Method' => 'Update',
                            'id_user' => $id,
                            'update_id_managers_on' => $this->request->post('id_managers'),
                            'update_id_bloggers_on' => $this->request->post('id_bloggers'),
                            'update_id_projects_on' => $this->request->post('id_projects'),
                        );
                                     
                        $log = date('Y-m-d H:i:s') . ' ' . print_r($array, true);
                        file_put_contents('../logs/users.txt', PHP_EOL . $str_log . PHP_EOL . $log . PHP_EOL . $str_log, FILE_APPEND);

                    // END LONG NONE UPDATE //

                // ======================== END LOGS UPDATE =============================== //


                if ($model->load($this->request->post()))
                {
                    $model->attached_projekt = $this->request->post('attached_projekt');
                    $model->attached_blogger = $this->request->post('attached_blogger');
                    $model->update_user_id = Yii::$app->user->identity->id;
                    $model->update_date = date("Y-m-d H:i:s");
                    $model->save();

                    /// =========================== NodeKlientManager ===================================== ///
                    if(!empty($this->request->post('id_managers')))
                    {
                        //if ($this->request->post('id_projects'))
                        //{
                            // удаляем всех блогеров id которого редактируем
                            NodeKlientManager::deleteAll(['id_klient' => $id]);
                        //} else {

                            //$log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientManager | Связка: клиент - менеджер не удалена, так как поле id_pojects пришло пустым';
                            //file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                        //}

                        if ($this->request->post('id_projects'))
                        {
                            foreach ($this->request->post('id_projects') as $id_projects_post)
                            {
                                // Создаём связь с платформой и менеджером
                                foreach ($this->request->post('id_managers') as $id_managers_post)
                                {
                                    Yii::$app->db->createCommand()->batchInsert('node_klient_manager', ['id_project', 'id_manager', 'id_klient'], [
                                        [$id_projects_post, $id_managers_post, $id],
                                    ])->execute();
                                }
                            }
                        } else {

                            // Создаём связь с платформой и менеджером
                            foreach ($this->request->post('id_managers') as $id_managers_post)
                            {
                                Yii::$app->db->createCommand()->batchInsert('node_klient_manager', ['id_project', 'id_manager', 'id_klient'], [
                                    [0, $id_managers_post, $id],
                                ])->execute();
                            }

                            $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientManager | Пустая связь: клиент - проект';
                            file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                        }
                        
                    } else {

                        $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientManager | Пустая связь: клиент - менеджер';
                        file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                    }


                    /// =========================== NodeKlientBlogger ===================================== ///
                    if(!empty($this->request->post('id_bloggers')))
                    {
                        if ($this->request->post('id_projects'))
                        {
                            // удаляем всех блогеров id которого редактируем
                            NodeKlientBlogger::deleteAll(['id_klient' => $id]);
                        } else {

                            $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientBlogger | Связка: клиент - блоггер не удалена, так как поле id_pojects пришло пустым';
                            file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                        }

                        if ($this->request->post('id_projects'))
                        {
                            foreach ($this->request->post('id_projects') as $id_projects_post)
                            {
                                // Создаём связь с платформой и блогерами
                                foreach ($this->request->post('id_bloggers') as $id_bloggers_post)
                                {
                                    Yii::$app->db->createCommand()->batchInsert('node_klient_blogger', ['id_project', 'id_blogger', 'id_klient'], [
                                        [$id_projects_post, $id_bloggers_post, $id],
                                    ])->execute();
                                }
                            }
                        } else {

                            $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientBlogger | Пустая связь: клиент - проект';
                            file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                        }
                        
                    } else {

                        $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeKlientBlogger | Пустая связь: клиент - блогер';
                        file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                    }


                    /// =========================== NodeProjectKlient ===================================== ///
                    if(!empty($this->request->post('id_projects')))
                    {
                        NodeProjectKlient::deleteAll(['id_klient' => $id]);

                        foreach ($this->request->post('id_projects') as $id_projects_post)
                        {
                            Yii::$app->db->createCommand()->batchInsert('node_project_klient', ['id_project', 'id_klient'], [
                                [$id_projects_post, $id],
                            ])->execute();
                        }
                        
                    } else {

                        $log = date('Y-m-d H:i:s') . ' Controller: User | Method: Update | Node: NodeProjectKlient | Пустая связь: клиент - проекты';
                        file_put_contents('../logs/users.txt', PHP_EOL . $log, FILE_APPEND);
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id' => $model->id]);
            // }

            return $this->render('update', [
                'model'                         => $model,
                'managers_db'                   => $managers_db,
                'projekts_db'                   => $projekts_db,
                'managers_node_db'              => $managers_node_db,
                'projects_node_db'              => $projects_node_db,
                'bloggers_node_db'              => $bloggers_node_db,
                'bloggers_db'                   => $bloggers_db,
            ]);
            
        } //access_update
    }

    /**
     * Deletes an existing UserForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // Выводим всех клиентов
        $klients_db = User::find()
            ->select('id')
            ->where(['role' => ['klient'], 'id' => $id])
            ->all();


        if (Yii::$app->user->identity->role == 'manager')
        {
            if ($klients_db == true)
            {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);

            } else {
                throw new HttpException(403, 'Вам не разрешено этого делать');
            }
        }

        if (Yii::$app->user->identity->role == 'admin')
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the UserForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return UserForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
