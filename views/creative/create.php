<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreativeForm */

$this->title = Yii::t('app', 'Добавление креатива');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creative Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creative-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="creative-form-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label class="control-label" for="projectform-platform">Выберите формат:</label>

            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="format">
                <option value="пост">пост</option>
                <option value="сторис">сторис</option>
                <option value="интеграция">интеграция</option>
                <option value="преролл">преролл</option>
                <option value="видеопост">видеопост</option>
            </select>
        </div>

        <?= $form->field($model, 'media_link')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
