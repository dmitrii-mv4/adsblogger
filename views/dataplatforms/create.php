<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataPlatformsForm */

$this->title = Yii::t('app', 'Добавление площадки для блогера');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Data Platforms Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-platforms-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="data-platforms-form-form manager_form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label class="control-label" for="projectform-platform">Выберите платформу: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_platform">
                <option value="0">--- выберите платформу ---</option>
                <?php foreach ($platforms_db as $platforms) { ?>
                    <option value="<?=$platforms->id ?>"><?=$platforms->title ?></option>
                <? } ?>
            </select>
            <span class="error_form"><?= Yii::$app->session->getFlash('empty_platform'); ?></span>
        </div>

        <div class="accordion" id="accordionExample">
                
            <div class="mb-0 shadow-none">
                <div id="heading_58">
                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapse_account" aria-expanded="false" aria-controls="collapse_account" style="width: 100%; padding: 0;"> 
                        <h5 class="my-1" style="text-align: initial;">
                            <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>                     
                        </h5> 
                    </button>
                </div>
                                            
                <div id="collapse_account" class="collapse" aria-labelledby="heading_58" data-parent="#accordionExample">
                    <?= $form->field($model, 'account_link')->textInput(['maxlength' => true, 'type' => 'url']) ?>
                </div>
            </div> <!-- end card -->
 
        </div>


        <?= $form->field($model, 'subscribers')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($model, 'coverage')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($model, 'integration_cost')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <div class="form-group">
            <label class="control-label" for="projectform-platform">Пол: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="audience_gender">
                <option value="0">--- Выберите пол аудитории ---</option>
                <option value="Мужчины">Мужчины</option>
                <option value="Женщины">Женщины</option>
                <option value="50 на 50">50 на 50</option>
            </select>
            <span class="error_form"><?= Yii::$app->session->getFlash('empty_audience_gender'); ?></span>
        </div>

        <? //$form->field($model, 'cpm')->textInput(['maxlength' => true, 'disabled' => true]) ?>

        <? //$form->field($model, 'cpv')->textInput(['maxlength' => true, 'value' => 'g455', 'disabled' => true]) ?>

        <div class="form-group">
            <label class="control-label" for="projectform-platform">Формат: *</label>

            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="format">
                <option value="0">--- Выберите формат ---</option>
                <option value="пост">пост</option>
                <option value="сторис">сторис</option>
                <option value="интеграция">интеграция</option>
                <option value="преролл">преролл</option>
                <option value="видеопост">видеопост</option>
            </select>
            <span class="error_form"><?= Yii::$app->session->getFlash('empty_format'); ?></span>
        </div>

        <?= $form->field($model, 'involvement')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'involvement_promotional_post')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
