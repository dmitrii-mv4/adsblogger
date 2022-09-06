<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use app\models\ProjectForm;
use app\models\PlatformForm;
use app\models\User;
use app\models\node\NodeProjectKlient;


$its = $data['its'];
?>
<? foreach ($its as $users_klient) { ?>

    <div class="card border mb-0 shadow-none box_users_klient_no_projects">
        <div class="card-header p-0" id="">
            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$users_klient->id ?>" aria-expanded="true" aria-controls="collapse_<?=$users_klient->id ?>"> 
                
                <h5 class="my-1">
                                    
                    <?php if ($users_klient->avatar) { ?>
                        <img src="<?=$users_klient->avatar ?>" alt="Нет изображения" class="thumb-xl rounded-circle">
                    <?php } else { ?>
                        <img src="/web/images/users/user-1.jpg" alt="Нет изображения" class="thumb-xl rounded-circle">
                    <? } ?>

                    <b><?=$users_klient->name ?></b>
                    <p class="group"><?=$users_klient->name_company ?> </p>
                                                                  
                </h5> 
            </button>

        </div>

    </div> <!-- end card -->

<? } ?>
