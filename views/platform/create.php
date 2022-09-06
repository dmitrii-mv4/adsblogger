<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $platforms_model app\models\PlatformForm */

$this->title = Yii::t('app', 'Создание платформы');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Platform Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platform-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="platform-form-form">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($platforms_model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($platforms_model, 'img')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
