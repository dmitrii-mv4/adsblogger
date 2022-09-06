<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DataPlatformsForm */

$this->title = Yii::t('app', 'Редактирование платформы');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Platforms Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-platforms-form-view manager_form">

    <h1><?='Редактирование платформы блогера: '.$blogger_name_one->name ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_platform',
            'id_blogger',
            'account',
            'subscribers',
            'coverage',
            'integration_cost',
            'cpm',
            'cpv',
            'audience_gender',
            'involvement',
            'involvement_promotional_post',
            'update_user_id',
            'update_date',
            'create_user_id',
            'create_date',
        ],
    ]) ?>

</div>
