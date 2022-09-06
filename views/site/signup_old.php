<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1>Регистрация</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<div class="form-group">
    <div class="offset-lg-1 col-lg-11">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
