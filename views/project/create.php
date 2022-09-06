<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $projects_model app\models\ProjectForm */

$this->title = Yii::t('app', 'Создание проекта');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($projects_model, 'title')->textInput(['maxlength' => true]) ?>

        <!-- Привязка платформы -->
        <div class="form-group">
            <label class="control-label" for="projectform-platform">Выберите платформу: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_platform">
                <option value="0">--- выберите платформу ---</option>
                <optgroup label="Все платформы">
                    <?php foreach ($platforms_db as $platforms) { ?>
                        <option value="<?=$platforms->id ?>"><?=$platforms->title ?> [<?=$platforms->id ?>]</option>      
                    <? } ?>
                </optgroup>
            </select>
            <span class="error_form"><?= Yii::$app->session->getFlash('empty_platform'); ?></span>
        </div>

        <!-- Привязка менеджера -->
        <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Ответственный менеджер: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_manager">
                <option value="0">--- выберите менеджера ---</option>
                <optgroup label="Все менеджеры">
                    <?php foreach ($users_manager_db as $users_manager) { ?>
                        <option value="<?=$users_manager->id ?>"><?=$users_manager->name ?> [<?=$users_manager->id ?>]</option>      
                    <? } ?>
                </optgroup>
            </select>
            <span class="error_form"><?= Yii::$app->session->getFlash('empty_manager'); ?></span>
        </div>

        <!-- Привязка клиента -->
        <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Клиент: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_klient">
                <option value="0">--- выберите клиента ---</option>
                <optgroup label="Все клиенты">
                    <?php foreach ($users_klient_db as $users_klient) { ?>
                        <option value="<?=$users_klient->id ?>"><?=$users_klient->name_company ?> [<?=$users_klient->id ?>]</option>      
                    <? } ?>
                </optgroup>
            </select>

            <span class="error_form"><?= Yii::$app->session->getFlash('empty_klient'); ?></span>
        </div>

        <!-- Привязка нескольких блогеров -->
        <div class="form-group">
            <label class="control-label" for="projectform-klient">Блогеры:</label>
            <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_bloggers[]">   
                    
                <!-- все блогеры -->
                <optgroup label="Все блогеры">
                    <?php foreach ($bloggers_db as $bloggers) { ?>
                        <option value="<?=$bloggers->id ?>"><?=$bloggers->name; ?> [<?=$bloggers->id ?>]</option>
                    <? } ?>
                </optgroup>
            </select>
        </div>

        <?= $form->field($projects_model, 'budget')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <span class="error_form"><?= Yii::$app->session->getFlash('empty_post'); ?></span>

</div>


<?
// echo '<pre>';
// var_dump($platform);
// echo '</pre>';

?>


