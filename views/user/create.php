<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */

$this->title = Yii::t('app', 'Создание нового пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <a href="?type=manager">Создать менеджера</a>
    <br/>
    <a href="?type=klient">Создать клиента</a>

</div>

</div>
