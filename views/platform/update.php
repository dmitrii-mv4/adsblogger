<?php

use yii\helpers\Html;
use app\models\PlatformForm;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlatformForm */

$this->title = Yii::t('app', 'Редактирование платформы: {name}', [
    'name' => $platforms_model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Platform Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $platforms_model->title, 'url' => ['view', 'id' => $platforms_model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="platform-form-update manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="platform-form-form">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($platforms_model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($platforms_model, 'img')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
