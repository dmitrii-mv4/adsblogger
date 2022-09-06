<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\DataPlatformsForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CreativeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Площадки блогера');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creative-form-index manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить площадку'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DataPlatformsForm $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
