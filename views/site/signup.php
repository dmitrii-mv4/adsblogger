<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">

                <?php $form = ActiveForm::begin(); ?>

                <span class="login100-form-title p-b-33">
                    Регистрация
                </span>

                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <div class="offset-lg-1 col-lg-11">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'login100-form-btn', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <div class="text-center">
                    <span class="txt1">
                        Есть аккаунт?
                    </span>

                    <a href="/login" class="txt2 hov1">
                        Войти
                    </a>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>