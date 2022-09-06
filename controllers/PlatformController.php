<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\HttpException; // 403 страница
use yii\web\NotFoundHttpException; // 404

use app\models\PlatformForm;
use app\models\PlatformSearch;

/**
 * PlatformController implements the CRUD actions for PlatformForm model.
 */
class PlatformController extends Controller
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

                            switch (Yii::$app->user->identity->role)
                            {
                                case 'admin':

                                    //if (Yii::$app->user->identity->id == 1 || 31)
                                    if (Yii::$app->user->identity->id == 1)
                                    {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                    
                                    break;

                                case 'manager':
                                    return false;
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
     * Lists all PlatformForm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PlatformSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlatformForm model.
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
     * Creates a new PlatformForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $platforms_model = new PlatformForm();

        if ($this->request->isPost)
        {
            $platforms_model->create_date = date("Y-m-d H:i:s"); // дата добавления
            $platforms_model->create_user_id = Yii::$app->user->identity->id; // пользователь который добавил
            
            if ($platforms_model->load($this->request->post()) && $platforms_model->save()) {
                return $this->redirect(['view', 'id' => $platforms_model->id]);
            }

        } else {
            $platforms_model->loadDefaultValues();
        }

        return $this->render('create', [
            'platforms_model' => $platforms_model,
        ]);
    }

    /**
     * Updates an existing PlatformForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $platforms_model = $this->findModel($id);

        if ($this->request->isPost)
        {
            $platforms_model->update_date = date("Y-m-d H:i:s"); // дата редактирования
            $platforms_model->update_user_id = Yii::$app->user->identity->id; // пользователь который редактировал
            
            if ($platforms_model->load($this->request->post()) && $platforms_model->save()) {
                return $this->redirect(['view', 'id' => $platforms_model->id]);
            }
        } else {
            $platforms_model->loadDefaultValues();
        }

        return $this->render('update', [
            'platforms_model' => $platforms_model,
        ]);
    }

    /**
     * Deletes an existing PlatformForm model.
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
     * Finds the PlatformForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return PlatformForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($platforms_model = PlatformForm::findOne(['id' => $id])) !== null) {
            return $platforms_model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
