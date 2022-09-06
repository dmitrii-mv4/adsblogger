<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectForm */

$this->title = Yii::t('app', 'Редактирование проекта: {name}', [
    'name' => $projects_model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $projects_model->title, 'url' => ['view', 'id' => $projects_model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-form-update manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($projects_model, 'title')->textInput(['maxlength' => true]) ?>

        <!-- Привязка платформы -->
        <div class="form-group">
            <label class="control-label" for="projectform-platform">Платформа: *</label>
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_platform">
                
                <?php foreach ($platforms_node_db as $platforms_node) { ?>
                    <option value="<?=$platforms_node->id ?>"><?=$platforms_node->title ?> [<?=$platforms_node->id ?>]</option>      
                <? } ?>
                
                <optgroup label="Все менеджеры">
                    <?php foreach ($platforms_db as $platforms) { ?>
                        <option value="<?=$platforms->id ?>"><?=$platforms->title ?> [<?=$platforms->id ?>]</option>      
                    <? } ?>
                </optgroup>
            
            </select>
        </div>

        <!-- Привязка менеджера -->
        <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Ответственный менеджер: *</label>
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_manager">
               
                <?php foreach ($managers_node_db as $managers_node) { ?>
                    <option value="<?=$managers_node->id ?>"><?=$managers_node->name ?> [<?=$managers_node->id ?>]</option>      
                <? } ?>
                
                <optgroup label="Все менеджеры">
                    <?php foreach ($managers_db as $managers) { ?>
                        <option value="<?=$managers->id ?>"><?=$managers->name ?> [<?=$managers->id ?>]</option>      
                    <? } ?>
                </optgroup>

            </select>
        </div>

        <!-- Привязка клиента -->
        <div class="form-group">
            <label class="control-label" for="projectform-klient">Клиент: *</label>
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_klient">
                
                <?php foreach ($klients_node_db as $klients_node) { ?>
                    <option value="<?=$klients_node->id ?>"><?=$klients_node->name_company ?> [<?=$klients_node->id ?>]</option>      
                <? } ?>
                
                <optgroup label="Все клиенты">
                    <?php foreach ($users_klient_db as $users_klient) { ?>
                        <option value="<?=$users_klient->id ?>"><?=$users_klient->name_company ?> [<?=$users_klient->id ?>]</option>  
                    <? } ?>
                </optgroup>

            </select>
        </div>

        <!-- Привязка нескольких блогеров -->
        <div class="form-group">
            <label class="control-label" for="projectform-klient">Блогеры:</label>
            <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_bloggers[]">

                <!-- все привязанные блогеры -->
                <optgroup label="Блогеры сейчас">

                    <? foreach ($bloggers_node_db as $bloggers_node) { ?>
                        <option selected="selected" value="<?=$bloggers_node->id ?>"><?=$bloggers_node->name ?> [<?=$bloggers_node->id ?>]</option>
                    <?php } ?>

                </optgroup>    
                    
                <!-- все блогеры -->
                <optgroup label="Все блогеры">
                    <?php foreach ($bloggers_db as $bloggers) { ?>
                        <option value="<?=$bloggers->id ?>"><?=$bloggers->name; ?> [<?=$bloggers->id; ?>]</option>
                    <? } ?>
                </optgroup>
            </select>
        </div>

        <?= $form->field($projects_model, 'budget')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
