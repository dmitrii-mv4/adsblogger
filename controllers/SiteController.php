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

class SiteController extends Controller
{
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
        return $this->render('index');
    }

    // Регистрация
    public function actionSignup()
    {
        //$this->layout = 'guest';
        
        // проверка доступа к странице
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        //$this->setMeta('Регистрация');
        $model = new SignupForm();

        // проверка поступления данных
        if($model->load(Yii::$app->request->post()))
        {
            $model->signup_date = date("Y-m-d H:i:s"); // дата добавления
            $model->password = Yii::$app->security->generatePasswordHash($model->password);

            // проверка на валидацию полей и добавление в БД
            if($model->save())
            {
                //Yii::$app->user->login($user);
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Не все поля заполнены!');
            }      
        }


        // проверка поступления данных (старая)
        // if($model->load(\Yii::$app->request->post()) && $model->validate())
        // {
        //     $user = new User();
        //     $user->username = $model->username;
        //     $user->password = $model->password;
        //     $user->password = \Yii::$app->security->generatePasswordHash($model->password);

        //     // сохраняем пользователя в БД
        //     if($user->save())
        //     {
        //         \Yii::$app->user->login($user);
        //         return $this->goHome();
        //     }
        // }

        return $this->render('signup', compact('model'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            switch (Yii::$app->user->identity->role) {
                case 'admin':
                    Yii::$app->response->redirect(Url::to('/manager'));
                    break;

                case 'manager':
                    Yii::$app->response->redirect(Url::to('/manager'));
                    break;

                case 'klient':
                    Yii::$app->response->redirect(Url::to('/klient'));
                    break;
                
                default:
                    return $this->goHome();
                    break;
            }

            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
