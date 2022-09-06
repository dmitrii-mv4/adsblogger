<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserForm */

$this->title = Yii::t('app', 'Редактирование пользователя: {username}', [
    'username' => $model->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-form-update manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <!-- Если редактируемый пользователь является менеджером -->
        <? //if ($model->role == 'manager') { ?>
            
            <!-- <div class="form-group">
                <label class="control-label">Пароль:</label>
                <input type="password" class="form-control" name="">
                
                <div class="help-block"></div>
            </div>

            <div class="form-group">
                <label class="control-label">Подтвердите пароль:</label>
                <input type="password" class="form-control" name="">
                
                <div class="help-block"></div>
            </div> -->
        <? //} ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']); ?>

        <? if ($model->role == 'klient') 
        {
            echo $form->field($model, 'name_company')->textInput(['maxlength' => true, 'required' => true]); 
        } ?>

        <? if ($model->role == 'klient') 
        {
            echo $form->field($model, 'description')->textarea(['maxlength' => true]); 
        } ?>

        <? if ($model->role == 'klient') { ?>

            <!-- multi select менеджеров -->
            <div class="form-group">
                <label class="control-label">Выберите ответственных менеджеров:</label>

                <!-- Привязка менеджеров -->
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_managers[]">
                    
                    <!-- все привязанные менеджеры -->
                    <optgroup label="Ответственные менеждеры сейчас">

                        <? foreach ($managers_node_db as $managers_node) { ?>
                            <option selected="selected" value="<?=$managers_node->id ?>"><?=$managers_node->name ?> [<?=$managers_node->id ?>]</option>
                        <?php } ?>
                    </optgroup>    
                
                    <!-- все менеджеры -->
                    <optgroup label="Все менеджеры">
                        <?php foreach ($managers_db as $managers) { ?>
                                
                            <!-- Фильтруем менеждеров и выводим только тех которые не привязанные -->
                            <?php //if ($users_manager->id != $table_links_manager_active->id) { ?>
                                <option value="<?=$managers->id ?>"><?=$managers->name; ?> [<?=$managers->id ?>]</option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

                <div class="help-block"></div>
            </div>
        <? } ?>

        <? if ($model->role == 'klient') { ?>

            <!-- multi select проекты -->
            <div class="form-group">
                <label class="control-label">Выберите проеты:</label>

                <!-- Привязка проектов -->
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_projects[]">
                    
                    <!-- все привязанные клиенты -->
                    <optgroup label="Проеты сейчас">

                        <? foreach ($projects_node_db as $projects_node) { ?>
                            <option selected="selected" value="<?=$projects_node->id ?>"><?=$projects_node->title ?> [<?=$projects_node->id ?>]</option>
                        <?php } ?>

                    </optgroup>
                
                    <!-- все проекты -->
                    <optgroup label="Все проекты">
                        <?php foreach ($projekts_db as $projects) { ?>
                                
                            <!-- Фильтруем проекты и выводим только тех которые не привязанные -->
                            <?php //if ($users_klient->id != $table_links_klient_active->id) { ?>
                                <option value="<?=$projects->id ?>"><?=$projects->title; ?> [<?=$projects->id ?>]</option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

                <div class="help-block"></div>
            </div>
            
        <? } ?>

        <? if ($model->role == 'klient') { ?>

            <!-- multi select блогеры -->
            <div class="form-group">
                <label class="control-label">Выберите блогеры:</label>

                <!-- Привязка блогеров -->
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
                                
                            <!-- Фильтруем блогеры и выводим только тех которые не привязанные -->
                            <?php //if ($users_klient->id != $table_links_klient_active->id) { ?>
                                <option value="<?=$bloggers->id ?>"><?=$bloggers->name; ?> [<?=$bloggers->id ?>]</option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

                <div class="help-block"></div>
            </div>
        <? } ?>

        <? if ($model->role == 'klient') 
        {
            echo $form->field($model, 'url_site')->textInput(['maxlength' => true]); 
        } ?>

        <?= $form->field($model, 'avatar')->textInput(['maxlength' => true, 'type' => 'url']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
