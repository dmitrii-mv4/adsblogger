<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">

                <?php $form = ActiveForm::begin(); ?>

                <span class="login100-form-title p-b-33">
                    Войти
                </span>

                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <div class="offset-lg-1 col-lg-11">
                        <?= Html::submitButton('Войти', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <div class="text-center p-t-45 p-b-4">
                    <span class="txt1">
                        Забыли
                    </span>

                    <a href="#" class="txt2 hov1">
                        E-mail / пароль?
                    </a>
                </div>

                <div class="text-center">
                    <span class="txt1">
                        Нет аккаунта?
                    </span>

                    <a href="/signup" class="txt2 hov1">
                        Зарегистрироваться
                    </a>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>