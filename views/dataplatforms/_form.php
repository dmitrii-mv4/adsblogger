<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataPlatformsForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-platforms-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'id_platform')->textInput() ?>

    <?= $form->field($model, 'id_blogger')->textInput() ?>

    <?= $form->field($model, 'account')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subscribers')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coverage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'integration_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audience_gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'involvement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'involvement_promotional_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_user_id')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
