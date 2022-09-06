<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataplatformsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-platforms-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_platform') ?>

    <?= $form->field($model, 'id_blogger') ?>

    <?= $form->field($model, 'account') ?>

    <?= $form->field($model, 'subscribers') ?>

    <?php // echo $form->field($model, 'coverage') ?>

    <?php // echo $form->field($model, 'integration_cost') ?>

    <?php // echo $form->field($model, 'cpm') ?>

    <?php // echo $form->field($model, 'cpv') ?>

    <?php // echo $form->field($model, 'audience_gender') ?>

    <?php // echo $form->field($model, 'involvement') ?>

    <?php // echo $form->field($model, 'involvement_promotional_post') ?>

    <?php // echo $form->field($model, 'update_user_id') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'create_user_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
