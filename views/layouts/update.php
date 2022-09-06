<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\PlatformForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectForm */

$this->title = Yii::t('app', 'Редактирование блогера');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <a href="/dataplatforms/create?blogger_id=<?=$bloggers_one_model->id ?>" class="btn btn-outline-purple waves-effect waves-light" style="float:right; margin-right: 20px;" target="_blank">Добавить площадку</a>
    <br/>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($bloggers_one_model, 'name')->textInput(['maxlength' => true]) ?>

        <!-- Категория -->
        <div class="form-group">
            <label class="control-label" for="projectform-platform">Категория:</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_category">
                
                <?php foreach ($category_db as $category)
                    {
                        if ($category->id == $bloggers_one_model->id_category)
                        {
                            $category_title = $category->title;
                        }
                    }
                ?>
                <option value="<?=$category->id ?>"><?=$category_title ?></option>
                <optgroup label="Все категории">
                    <?php foreach ($category_db as $category) { ?>
                        <option value="<?=$category->id ?>"><?=$category->title ?></option>      
                    <? } ?>
                </optgroup>

            </select>
        </div>
        

        <!-- <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Площадки:</label><br/>
            <span class="badge badge-success">Instagram</span>
            <span class="badge badge-success">YouTube</span>
        </div> -->    

        <!-- multi select менеджеров -->
        <div class="form-group">
            <label class="control-label">Выберите ответственных менеджеров:</label>

                <!-- Привязка менеджеров -->
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_managers[]">
                    
                    <!-- Сейчас привязанные менеджеры -->
                    <optgroup label="Ответственные менеждеры сейчас">

                        <? foreach ($managers_node_db as $managers_node) { ?>
                            <option value="<?=$managers_node->id ?>"><option value="<?=$managers->id ?>"><?=$managers_node->name; ?></option></option>
                        <?php } ?>
                    </optgroup>    
                
                    <!-- Все менеджеры -->
                    <optgroup label="Все менеджеры">
                        <?php foreach ($managers_db as $managers) { ?>
                                
                            <!-- Фильтруем менеждеров и выводим только тех которые не привязанные -->
                            <?php //if ($users_manager->id != $table_links_manager_active->id) { ?>
                                <option value="<?=$managers->id ?>"><?=$managers_node->name; ?></option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

            <div class="help-block"></div>
        </div>

         <!-- multi select клиенты -->
         <div class="form-group">
            <label class="control-label">Выберите клиентов:</label>

                <!-- Привязка клиентов -->
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_klients[]">
                    
                    <!-- все привязанные клиенты -->
                    <optgroup label="Клиенты сейчас">

                        <? foreach ($klients_node_db as $klients) { ?>
                            <option value="<?=$klients->id ?>"><?=$klients->username ?></option>
                        <?php } ?>

                    </optgroup>    
                
                    <!-- все клиенты -->
                    <optgroup label="Все клиенты">
                        <?php foreach ($klients_db as $klients) { ?>
                                
                            <!-- Фильтруем клиентов и выводим только тех которые не привязанные -->
                            <?php //if ($users_klient->id != $table_links_klient_active->id) { ?>
                                <option value="<?=$klients->id ?>"><?=$klients->username; ?></option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

            <div class="help-block"></div>
        </div>

        <!-- multi select проекты -->
        <div class="form-group">
            <label class="control-label">Выберите проеты:</label>

                <!-- Привязка проектов -->
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="id_projects[]">
                    
                    <!-- все привязанные клиенты -->
                    <optgroup label="Проеты сейчас">

                        <? foreach ($projects_node_db as $projects_node) { ?>
                            <option value="<?=$projects_node->id ?>"><?=$projects_node->title ?></option>
                        <?php } ?>

                    </optgroup>    
                
                    <!-- все проекты -->
                    <optgroup label="Все проекты">
                        <?php foreach ($projects_db as $projects) { ?>
                                
                            <!-- Фильтруем проекты и выводим только тех которые не привязанные -->
                            <?php //if ($users_klient->id != $table_links_klient_active->id) { ?>
                                <option value="<?=$projects->id ?>"><?=$projects->title; ?></option>
                            <?php //} ?>

                        <? } ?>
                    </optgroup>
                </select>

            <div class="help-block"></div>
        </div>

        <!-- выбор 1 менеджера -->
        <!-- <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Выберите менеджера:</label>
            <select id="projectform-responsible_manager" class="form-control" name="responsible_manager">
                <option value="<?//bloggers_one_model['responsible_manager'] ?>"><?//$bloggers_one_model['responsible_manager'] ?></option>
                <option value="">Не привязывать</option>
                <?php //foreach ($users_manager_db as $users_manager) { ?>
                    <option value="<?//$users_manager['username'] ?>"><?//$users_manager['username'] ?></option>      
                <? //} ?>
            </select>

             <div class="help-block"></div>
        </div> -->

        <?= $form->field($bloggers_one_model, 'description')->textArea() ?>

        <?= $form->field($bloggers_one_model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($bloggers_one_model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($bloggers_one_model, 'comment_topic')->textArea() ?>

        <?= $form->field($bloggers_one_model, 'blogger_preference')->textArea() ?>

        <h3>Платформы</h3>

        <?php foreach ($data_platforms_db as $data_platforms) { ?>
            <div class="accordion" id="accordionExample" style="margin: 0px 200px 0 200px;">
                <div class="card border mb-0 shadow-none" style="border-bottom-color: white!important;">
                    <div class="card-header p-0" id="heading<?=$data_platforms->id ?>">
                        <h5 class="my-1">
                            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse<?=$data_platforms->id ?>" aria-expanded="true" aria-controls="collapse<?=$data_platforms->id ?>">
                                <?php
                                    // Выводим название платформы
                                    $platforms = PlatformForm::find()
                                        ->where(['id' => $data_platforms->id_platform])
                                        ->all();
                                
                                    foreach ($platforms as $platform)
                                    {
                                        echo $platform->title;
                                    }
                                ?>
                            </button>
                        </h5>
                    </div>
                                        
                    <div id="collapse<?=$data_platforms->id ?>" class="collapse" aria-labelledby="heading<?=$data_platforms->id ?>" data-parent="#accordionExample" style="">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Аккаунт: <?=$data_platforms->account ?></li>
                                <li class="list-group-item">Подписчиков: <?=$data_platforms->subscribers ?></li>
                                <li class="list-group-item">Охват: <?=$data_platforms->coverage ?></li>
                                <li class="list-group-item">Стоимость интеграции: <?=$data_platforms->integration_cost ?></li>
                                <li class="list-group-item">Пол: <?=$data_platforms->audience_gender ?></li>
                                <li class="list-group-item">Cpm: <?=$data_platforms->cpm ?></li>
                                <li class="list-group-item">Cpv: <?=$data_platforms->cpv ?></li>
                                <li class="list-group-item">Формат: <?=$data_platforms->format ?></li>
                                <li class="list-group-item">Вовлечённость: <?=$data_platforms->involvement ?></li>
                                <li class="list-group-item">Вовлечённость по рекламным постам: <?=$data_platforms->involvement_promotional_post	 ?></li>
                            </ul>
                            <div class="card-body" style="padding: 10px;">
                                <a href="/dataplatforms/view?id=<?=$data_platforms->id ?>" class="card-link" target="_blank">Подробнее</a>
                                <a href="/dataplatforms/update?id=<?=$data_platforms->id ?>" class="card-link" target="_blank">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>                     
            </div>
        <? } ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>


<?
// echo '<pre>';
// var_dump($platform);
// echo '</pre>';

?>


