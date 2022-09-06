<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreativeForm */

$this->title = Yii::t('app', 'Редактирование креатива: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creative Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="creative-form-update manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="creative-form-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label class="control-label" for="projectform-platform">Выберите формат:</label>

            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="format">
                <option value="<?=$model->format ?>"><?=$model->format ?></option>
                <optgroup label="Все форматы">
                    <option value="пост">пост</option>
                    <option value="сторис">сторис</option>
                    <option value="интеграция">интеграция</option>
                    <option value="преролл">преролл</option>
                    <option value="видеопост">видеопост</option>
                </optgroup>
            </select>
        </div>
        
        <?= $form->field($model, 'media_link')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
