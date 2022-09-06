<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Приводим в норм именования ролей
switch ($model->role) {
    case 'admin':
        $model->role = 'Администратор';
        break;

    case 'manager':
        $model->role = 'Менеджер';
        break;

    case 'klient':
        $model->role = 'Клиент';
        break;
    
    default:
        $model->role = 'Роль пользователя не определена';
        break;
}

?>
<div class="user-form-view manager_form">

    <h1>Пользователь: <?= Html::encode($this->title) ?></h1>

    <p>
        <!-- Если это клиент, то скрываем кнопки -->
        <? if (Yii::$app->user->identity->role != 'klient')
        {
            echo Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            echo Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <? if ($model->role == 'Клиент') { ?>

        <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
                <tr>
                    <th>id:</th>
                    <td><?=$model->id ?></td>
                </tr>
                <tr>
                    <th>E-mail:</th>
                    <td><?=$model->username ?></td>
                </tr>
                <tr>
                    <th>Роль:</th>
                    <td><?=$model->role ?></td>
                </tr>
                <tr>
                    <th>Имя:</th>
                    <td><?=$model->name ?></td>
                </tr>
                <tr>
                    <th>Телефон:</th>
                    <td><?=$model->phone ?></td>
                </tr>
                <tr>
                    <th>Наименование компании:</th>
                    <td><?=$model->name_company ?></td>
                </tr>
                <tr>
                    <th>Сайт:</th>
                    <td><a href="<?=$model->url_site ?>" target="_blank"><?=$model->url_site ?></a></td>
                </tr>
                <tr>
                    <th>Дата создания:</th>
                    <td><?=$model->signup_date ?></td>
                </tr>
            </tbody>
        </table>

    <? } else { ?>

        <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
                <tr>
                    <th>id:</th>
                    <td><?=$model->id ?></td>
                </tr>
                <tr>
                    <th>E-mail:</th>
                    <td><?=$model->username ?></td>
                </tr>
                <tr>
                    <th>Роль:</th>
                    <td><?=$model->role ?></td>
                </tr>
                <tr>
                    <th>Имя:</th>
                    <td><?=$model->name ?></td>
                </tr>
                <tr>
                    <th>Телефон:</th>
                    <td><?=$model->phone ?></td>
                </tr>
                <tr>
                    <th>Дата создания:</th>
                    <td><?=$model->signup_date ?></td>
                </tr>
            </tbody>
        </table>

    <? } ?>

</div>
