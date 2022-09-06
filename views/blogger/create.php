<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CategoryForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectForm */

$this->title = 'Создание блогера';
$this->params['breadcrumbs'][] = $this->title;
//$this->title = Yii::t('app', 'Создание блогера');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Forms'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-form-create manager_form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($bloggers_model, 'name')->textInput(['maxlength' => true]) ?>

        <!-- Категория -->
        <div class="form-group">
            <label class="control-label" for="projectform-platform">Выберите категорию: *</label>
                
            <select class="select2 form-control mb-3 custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true" name="id_category">
                <option value="0">--- выберите категорию ---</option>
                <optgroup label="Все категории">
                    <?php foreach ($categories_db as $categories) { ?>
                        <option value="<?=$categories->id ?>"><?=$categories->title ?></option>
                    <? } ?>
                </optgroup>
            </select>

            <span class="error_form"><?= Yii::$app->session->getFlash('empty_category'); ?></span>
        </div>

        <!-- <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Площадки:</label><br/>
            <span class="badge badge-success">Instagram</span>
            <span class="badge badge-success">YouTube</span>
        </div> -->

        <!-- <div class="form-group">
            <label class="control-label">Выберите менеджера:</label>
                
                <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Выерите 1 или нескольких" name="responsible_manager[]">
                    <option value="">Не привязывать</option>
                    <?php //foreach ($users_manager_db as $users_manager) { ?>
                        <option value="<?//$users_manager['id'] ?>"><?//$users_manager['username'] ?></option>      
                    <? //} ?>
                </select>

            <div class="help-block"></div>
        </div> -->

                                        <!-- Копия Multiple select
                                        <div class="col-md-6">
                                            <h6 class="mt-lg-0 input-title">Multiple Select</h6>

                                            <select class="select2 mb-3 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                                <optgroup label="Central Time Zone">
                                                    <option value="AL">Alabama</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="WI">Wisconsin</option>
                                                </optgroup>
                                                <optgroup label="Eastern Time Zone">
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WV">West Virginia</option>
                                                </optgroup>
                                            </select> 
                                        </div> -->                                                

        <!-- <div class="form-group">
            <label class="control-label" for="projectform-responsible_manager">Выберите менеджера:</label>
            <select id="projectform-responsible_manager" class="form-control" name="responsible_manager">
                <option value="">Не привязывать</option> -->
                <?//php foreach ($users_manager_db as $users_manager) { ?>
                    <!-- <option value="<?//$users_manager['username'] ?>"><?//$users_manager['username'] ?></option>       -->
                <? //} ?>
            <!-- </select>

             <div class="help-block"></div>
        </div> -->

        <?= $form->field($bloggers_model, 'description')->textArea() ?>

        <?= $form->field($bloggers_model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($bloggers_model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']) ?>

        <?= $form->field($bloggers_model, 'comment_topic')->textArea() ?>

        <?= $form->field($bloggers_model, 'blogger_preference')->textArea() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
        </div>

        <span class="error_form"><?= Yii::$app->session->getFlash('empty_post'); ?></span>

    <?php ActiveForm::end(); ?>

</div>
