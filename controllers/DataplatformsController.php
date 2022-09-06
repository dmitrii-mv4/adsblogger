<?php

namespace app\controllers;

use Yii;
use app\models\DataPlatformsForm;
use app\models\DataplatformsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PlatformForm;
use app\models\BloggerForm;
use yii\filters\AccessControl;
use yii\web\HttpException; // 403

/**
 * DataplatformsController implements the CRUD actions for DataPlatformsForm model.
 */
class DataplatformsController extends Controller
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
                'only' => ['index', 'view', 'create', 'update', 'delete'], // действия в контроллере
                'rules' => [ // правила к действиям
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'], // действия в контроллере
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
     * Lists all DataPlatformsForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DataplatformsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataPlatformsForm model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Выводим имя блогера принадлежащему платформе
        $blogger_name_one = BloggerForm::find()
            ->select('name')
            ->leftJoin('data_platforms', '`data_platforms`.`id_blogger` = `bloggers`.`id`')
            ->Where(['data_platforms.id_blogger' => $model->id_blogger, 'id_platform' => $model->id_platform])
            ->one();

        return $this->render('view', [
            'model'            => $model,
            'blogger_name_one' => $blogger_name_one,
        ]);
    }

    /**
     * Creates a new DataPlatformsForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new DataPlatformsForm();
        $platforms_db = PlatformForm::find()->all();
        $data_platforms_db = DataPlatformsForm::find()->all();

        // Ограничение на создание платформ блогеру
        foreach ($data_platforms_db as $data_platform)
        {
            if ($data_platform->id_blogger == Yii::$app->request->get('blogger_id'))
            {
                throw new HttpException(404, 'Вы не можете создать больше 1 платформы для блогера!');
                die;
            }
        }

        if ($this->request->isPost)
        {
            if (!Yii::$app->request->get('blogger_id'))
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Dataplatforms | Method: Create | id блогера пустой в get запросе';
                file_put_contents('../logs/dataplatforms.txt', PHP_EOL . $log, FILE_APPEND);

                throw new HttpException(500, 'Ошибка запроса!');
                die;
            }

            if ($this->request->post('id_platform') == 0)
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Dataplatforms | Method: Create | Платформа не выбрана';
                file_put_contents('../logs/dataplatforms.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_platform', 'Выберите платформу');
                return $this->redirect('create?blogger_id='.Yii::$app->request->get('blogger_id'));
                die;
            }

            if (empty($this->request->post('audience_gender')))
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Dataplatforms | Method: Create | Пол аудитории не выбран';
                file_put_contents('../logs/dataplatforms.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_audience_gender', 'Выберите пол аудитории');
                return $this->redirect('create?blogger_id='.Yii::$app->request->get('blogger_id'));
                die;
            }

            if (empty($this->request->post('format')))
            {
                // Отправляем в лонг
                $log = date('Y-m-d H:i:s') . ' | Controller: Dataplatforms | Method: Create | Формат не выбран';
                file_put_contents('../logs/dataplatforms.txt', PHP_EOL . $log, FILE_APPEND);

                // Отправляем уведомление на фронт
                Yii::$app->getSession()->setFlash('empty_format', 'Выберите формат');
                return $this->redirect('create?blogger_id='.Yii::$app->request->get('blogger_id'));
                die;
            }


            if ($integration_cost = $this->request->post('DataPlatformsForm')['integration_cost'] && $this->request->post('DataPlatformsForm')['coverage'])
            {
                $cpm = $integration_cost = $this->request->post('DataPlatformsForm')['integration_cost'] / $this->request->post('DataPlatformsForm')['coverage'] * 1000;
                $cpv = $integration_cost = $this->request->post('DataPlatformsForm')['integration_cost'] / $this->request->post('DataPlatformsForm')['coverage'];
            } else {
                $cpm = 0;
                $cpv = 0;
            }

            if ($model->load($this->request->post()) && $model->save())
            {
                $model->audience_gender = $this->request->post('audience_gender');
                $model->id_platform = $this->request->post('id_platform');
                $model->id_blogger = Yii::$app->request->get('blogger_id');
                $model->create_date = date("Y-m-d H:i:s");
                $model->create_user_id = Yii::$app->user->identity->id;
                $model->cpm = $cpm;
                $model->cpv = $cpv;
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'        => $model,
            'platforms_db' => $platforms_db,
        ]);
    }

    /**
     * Updates an existing DataPlatformsForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $platforms_db = PlatformForm::find()->all();

        // Выводим привязаную платформу
        $node_platfom_db = PlatformForm::find()
            ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
            ->Where(['data_platforms.id_platform' => $model->id_platform])
            ->all();

        // Выводим имя блогера принадлежащему платформе
        $blogger_name_one = BloggerForm::find()
            ->select('name')
            ->leftJoin('data_platforms', '`data_platforms`.`id_blogger` = `bloggers`.`id`')
            ->Where(['data_platforms.id_blogger' => $model->id_blogger, 'id_platform' => $model->id_platform])
            ->one();

        if ($this->request->isPost)
        {
            //if ($integration_cost = $this->request->post('DataPlatformsForm')['integration_cost'] || $this->request->post('DataPlatformsForm')['coverage'])
            //{
                $cpm = $this->request->post('DataPlatformsForm')['integration_cost'] / $this->request->post('DataPlatformsForm')['coverage'] * 1000;
                $cpv = $this->request->post('DataPlatformsForm')['integration_cost'] / $this->request->post('DataPlatformsForm')['coverage'];
            //} else {
                //$cpm = 0;
                //$cpv = 0;
            //}

            if ($model->load($this->request->post()) && $model->save())
            {
                $model->audience_gender = $this->request->post('audience_gender');
                $model->id_platform = $this->request->post('id_platform');
                $model->id_blogger = $model->id_blogger;
                $model->update_date = date("Y-m-d H:i:s");
                $model->update_user_id = Yii::$app->user->identity->id;
                $model->cpm = $cpm;
                $model->cpv = $cpv;
                $model->save();

                //return $this->redirect(['blogger/view/', 'id' => $model->id_blogger]); // на view блогера
                return $this->redirect(['dataplatforms/view/', 'id' => $model->id]); // на view платформы блогера
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model'              => $model,
            'platforms_db'       => $platforms_db,
            'blogger_name_one'   => $blogger_name_one,
            'node_platfom_db'    => $node_platfom_db,
        ]);
    }

    /**
     * Deletes an existing DataPlatformsForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataPlatformsForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return DataPlatformsForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataPlatformsForm::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
