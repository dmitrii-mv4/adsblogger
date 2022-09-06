<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */

$this->title = Yii::t('app', 'Создание нового менеджера');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form-form">

    <?php $form = ActiveForm::begin(); ?>

    	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<label class="control-label">Пароль:</label>
			<input type="password" class="form-control" name="password" required>
					
			<div class="help-block"></div>
		</div>

		<div class="form-group">
			<label class="control-label">Подтвердите пароль:</label>
			<input type="password" class="form-control" name="password_repeat" required>
					
			<div class="help-block"></div>

			<?= Yii::$app->session->getFlash('error_password'); ?>
		</div>

		<? //$form->field($model, 'role',['inputOptions' => ['value' => 'manager']])->hiddenInput()->label(false) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']) ?> 

		<?= $form->field($model, 'avatar')->textInput(['maxlength' => true, 'type' => 'url']) ?>

	    <div class="form-group">
	        <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
	    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
