<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
use app\models\DataPlatformsForm;
use app\models\CategoryForm;
use app\models\PlatformForm;
use app\models\СreativesСommentsForm;
use app\models\User;

$this->title = 'В работе';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<!-- Menu -->
<div class="menu_top">
    <?
        // Если есть get запрос на project то подставляем
        if (Yii::$app->request->get('project'))
        {
            $get_project = '?project='.Yii::$app->request->get('project');
        }
    ?>

    <ul class="menu-funnel">
        <li class="menu-funnel-item">
            <a href="/manager<?=$get_project?>" class="nav-link">Лонг лист</a>
        </li>
        <li class="menu-funnel-item">
            <a href="/manager/agreed<?=$get_project?>" class="nav-link">Согласованные</a>
        </li>
        <li class="menu-funnel-item item-active">
            <a href="/manager/work<?=$get_project?>" class="nav-link">В работе</a>
        </li>
    </ul>
</div>

<? if (Yii::$app->request->get()) { ?>

    <div class="counter_td">

        <!-- Проверка на существования GET запроса -->
        <?php if(Yii::$app->request->get('project')) { ?>

            <table class="table mb-0 table-centered table_funnel">
                <thead class="table-th-manager-funnel">
                    
                    <tr>
                        <th class="funnel_th_item">
                            <div class="funnel_th_item_div">№ п/п</div>
                        </th>

                        <th class="funnel_th_avatar">
                            <div class="funnel_th_avatar_div"></div>
                        </th>

                        <th>
                            <div class="funnel_th_acaunt_div">Аккаун в инстаграм</div>
                        </th>

                        <th>
                            <div class="funnel_th_category_div">Категория</div>
                        </th>

                        <th class="funnel_th_subscribers">
                            <div>Подписчики</div>
                        </th>

                        <th class="funnel_th_coverage">
                            <div>Прогноз охват</div>
                        </th>

                        <th class="funnel_th_price">
                            <div>Цена</div>
                        </th>

                        <th class="funnel_th_format">
                            <div>Формат</div>
                        </th>

                        <th class="funnel_th_cpm">
                            <div>CPM</div>
                        </th>

                        <th class="funnel_th_btn">
                            <div class=" funner_table_end_right">Статус</div>
                        </th>

                        <th class="funnel_th_btn">
                            <div class="funnel_th_btn_div funner_table_end_right"></div>
                        </th>
                    </tr>

                </thead>
 
                <tbody>

                    <? if ($bloggers_waiting_creatives_db) { ?>

                        <th colspan="9" class="funner_th_title_work">Ожидаем отправки креативов</th>

                        <th class="funnel_th_btn_work">
                    
                            <?php $to_approve_form = ActiveForm::begin(); ?>

                            <?=Html::submitButton('согласовать', [
                                'name'  => 'btn',
                                'value' => 'to_approve_btn',
                                'class' => 'btn-approve'
                            ]); ?>

                        </th>
                                    
                        <?php foreach ($bloggers_waiting_creatives_db as $bloggers_waiting_creatives) { ?>

                            <tr class="funner_table_body funner_table_body_work">
                                                
                                <!-- id Блогера -->
                                <td class="funner_work_items_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                    
                                    <div class="agreed_items_div"></div>
                                                    
                                </td>

                                <!-- Изображение блогера -->
                                <td class="funner_table_td_common work_table_td_avatar collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                 
                                    <div class="agreed_table_avatar_div">
                                        <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                    </div>
                                                
                                </td>
                                                
                                <!-- Аккаунт -->
                                <td class="funner_table_td_common agreed_table_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                  
                                    <div class="agreed_table_div_title"><?=$bloggers_waiting_creatives->name;?>

                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="mdi mdi-settings"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                                <a class="dropdown-item" href="/blogger/view/<?=$bloggers_waiting_creatives->id;?>" >Посмотреть</a>
                                                <a class="dropdown-item" href="/blogger/update/<?=$bloggers_waiting_creatives->id;?>" >Редактировать</a>
                                            </div>
                                        </div>

                                        <span>
                                            <?php
                                                // Выводим img платформы
                                                $pltforms_img_blogger = PlatformForm::find()
                                                    ->select('img')
                                                    ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                    ->Where(['data_platforms.id_blogger' => $bloggers_waiting_creatives->id])
                                                    ->one();

                                                echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                                // Выводим макс. кол-во подписчиков
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                    ->max('subscribers');

                                                // Выводим данные платформ
                                                $data_platforms = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_waiting_creatives->id, 'subscribers' => $subscribers])
                                                    ->all();

                                                foreach ($data_platforms as $data_platform)
                                                {
                                                    echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                }
                                            ?>
                                        </span>

                                    </div>
                                                  
                                </td>

                                <!-- Категория -->
                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers_waiting_creatives->id_category])
                                        ->all();
                                    ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                      
                                        <div style="color: #b9b9ba;">
                                            <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                        </div>
                                                      
                                    </td>
                                <? } ?>
                                            
                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_subscribers_skine collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                  
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                ->max('subscribers');
                                        ?>

                                        <span class="funner_table_subscribers_skine"><?=$subscribers ?></span>
                                        <span class="funner_table_subscribers_statys_skine">
                                            <?php 
                                                if ($subscribers < $coverage_micro)
                                                {
                                                    echo '<span class="subscribers_status_miсro">микро</span>';
                                                }
                                                                                    
                                                if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_average">средний</span>';
                                                }

                                                if ($subscribers > $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_big">крупный</span>';
                                                }   
                                            ?>
                                        </span>
                                    </div>
                                </td>

                                <!-- Охват -->
                                <td class="funner_table_td_common funner_table_td_coverage collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                   
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_waiting_creatives->id, 'subscribers' => $subscribers])
                                                ->all();

                                            if ($coverages_db)
                                            {
                                                foreach ($coverages_db as $coverages)
                                                {
                                                    echo '<span class="funner_coverage">'.$coverages->coverage.'</span>';

                                                    // Прогноз охвата
                                                    $grade_coverage = substr($subscribers / $coverages->coverage, 0, 1);

                                                    if ($grade_coverage > 0 && intval($grade_coverage))
                                                    {
                                                        echo '<span class="funner_percent_coverage_green"> > '.$grade_coverage.'%</span>';
                                                    } else {
                                                        echo '<span class="funner_percent_coverage_red"> <'.$grade_coverage.'%</span>';
                                                    }
                                                }
                                            } else { echo '-'; }
                                        ?>
                                    </div>
                                            
                                </td>

                                <!-- Цена -->
                                <td class="funner_table_td_common funner_table_td_price collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                 
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                    ->one();

                                                if ($integration_cost_db)
                                                {
                                                    foreach ($integration_cost_db as $integration_cost)
                                                    {
                                                        echo $integration_cost;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                               
                                </td>

                                <!-- Формат -->
                                <td class="funner_table_td_common funner_table_td_format collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                  
                                    <div> 
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                    ->one();

                                                if ($format_db)
                                                {
                                                    foreach ($format_db as $format)
                                                    {
                                                        echo $format;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <!-- CPM -->
                                <td class="funner_table_td_common funner_table_td_cpm collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_waiting_creatives->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_waiting_creatives->id ?>">
                                                   
                                    <div> 
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_waiting_creatives->id])
                                                    ->one();

                                                if ($cpm_db)
                                                {
                                                    foreach ($cpm_db as $cpm)
                                                    {
                                                        echo $cpm;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <td class="funner_table_td_common work_funner_td_close_right">
                                    <div class="checkbox my-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2" name="status_waiting_creatives[<?=$bloggers_waiting_creatives->id;?>]">
                                            <label class="custom-control-label" for="customCheck02"></label>
                                        </div>
                                    </div>
                                </td>

                            </tr>

                            <th class="funner_work_th_btn_cread_creative" colspan="10">
                                <button class="funner_work_btn_cread_creative">
                                    <a href="/creative/create?id_project=<?=Yii::$app->request->get('project')?>&id_blogger=<?=$bloggers_waiting_creatives->id;?>">Добавить креатив</a>
                                </button>
                                
                            </th>

                        
                        <!-- Креативы Таблицы раздела "Ожидаем отправки креативов" -->
                        <th colspan="10">

                            <div id="collapse<?=$bloggers_waiting_creatives->id ?>" class="collapse" aria-labelledby="heading<?=$bloggers_waiting_creatives->id ?>" data-parent="#accordionExample">
                                <div class="card-body">

                                    <div class="work_creatives">
                                                                    
                                        <? foreach ($creative_db as $creative) { ?>
                                            <? if ($creative->id_blogger == $bloggers_waiting_creatives->id) { ?>

                                                <div class="work_creatives_skin">

                                                    <div class="d-flex mr-3 work_creative_load_left">

                                                        <?php

                                                            // Если это фото
                                                            if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                            { ?>
                                                                <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                    <img src="<?=$creative->media_link?>" alt="">
                                                                </a>
                                                            <? }
                                                            else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                            { ?>
                                                                <div>
                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                        <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                    </a>
                                                                </div>
                                                            <?php
                                                            }
                                                            else { 
                                                                echo 'Ошибка! Кретив не найден.';
                                                            }
                                                        ?>

                                                    </div>

                                                    <div class="work_creative_right">
                                                        <div class="work_creative_right_header">
                                                            <h5 class="mt-0">текст к публикации:</h5>

                                                            <div class="work_creative_left_header">
                                                                <span class="work_creative_publication"><?=$creative->format ?></span>
                                                                <a href="/creative/update?id=<?=$creative->id ?>&id_project=<?=Yii::$app->request->get('project')?>" class="btn_creative_work">редактировать</a>
                                                            </div>
                                                        </div>

                                                        <div class="work_creative_description">
                                                            <p><?=$creative->description ?></p>
                                                        </div>

                                                        <div class="work_coment_main">
                                                            <h5 class="mt-0">Комментарий по креативу:</h5>

                                                            <div class="work_creative_left_header">
                                                                <a class="btn_creative_work work_creative_btn_deactivated">комментарии</a>
                                                            </div>
                                                                
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий нет" disabled></textarea>
                                                            
                                                        </div>
                                                    </div>

                                                </div> <!-- end work_creative_neutral -->

                                            <? } ?>

                                        <? } ?>

                                    </div> <!-- end work_creatives -->

                                </div> <!-- end card-body -->

                            </div> <!-- end Креативы -->

                        </th>
       
                    <? } // foreach end $bloggers_waiting_creatives_db as $bloggers_waiting_creatives ?>

                </tbody>

                <?php ActiveForm::end(); ?>

            <? } // $bloggers_waiting_creatives_db ?>

                <tbody>

                    <? if ($bloggers_agreed_creative_db) { ?>
                        
                        <th colspan="9" class="funner_th_title_work">Креативы на согласовании</th>

                        <th>
                            <?php $form = ActiveForm::begin(); ?>

                            <?=Html::submitButton('согласовать', [
                                //'name'  => 'pending_publication',
                                'name'    => 'btn',
                                'value'   => 'pending_publication',
                                'class'   => 'btn-approve'
                            ]); ?>

                        </th>

                        <?php foreach ($bloggers_agreed_creative_db as $bloggers_agreed_creative) { ?>
                
                            <tr class="funner_table_body">
                                
                                <!-- id Блогера -->
                                <td class="funner_work_items_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">

                                    <div class="agreed_items_div"></div>

                                </td>
                                
                                <!-- Аватар блогера -->
                                <td class="funner_table_td_common work_table_td_avatar collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                 
                                    <div class="agreed_table_avatar_div">
                                        <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                    </div>
                                                
                                </td>

                                <!-- Аккаунт -->
                                <td class="funner_table_td_common agreed_table_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                  
                                    <div class="agreed_table_div_title"><?=$bloggers_agreed_creative->name;?>

                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="mdi mdi-settings"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                                <a class="dropdown-item" href="/blogger/view/<?=$bloggers_agreed_creative->id;?>">Посмотреть</a>
                                                <a class="dropdown-item" href="/blogger/update/<?=$bloggers_agreed_creative->id;?>">Редактировать</a>
                                            </div>
                                        </div>

                                        <span>
                                            <?php
                                                // Выводим img платформы
                                                $pltforms_img_blogger = PlatformForm::find()
                                                    ->select('img')
                                                    ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                    ->Where(['data_platforms.id_blogger' => $bloggers_agreed_creative->id])
                                                    ->one();

                                                echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                                // Выводим макс. кол-во подписчиков
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                    ->max('subscribers');

                                                // Выводим данные платформ
                                                $data_platforms = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_agreed_creative->id, 'subscribers' => $subscribers])
                                                    ->all();

                                                foreach ($data_platforms as $data_platform)
                                                {
                                                    echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                }
                                            ?>
                                        </span>
                                    </div>
                                                  
                                </td>

                                <!-- Категория -->
                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers_agreed_creative->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                      
                                            <div style="color: #b9b9ba;">
                                                <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                            </div>
                                                      
                                    </td>
                                <? } ?>
                                       
                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_subscribers_skine collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                  
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                ->max('subscribers');
                                        ?>

                                        <span class="funner_table_subscribers_skine"><?=$subscribers ?></span>
                                        <span class="funner_table_subscribers_statys_skine">
                                            <?php 
                                                if ($subscribers < $coverage_micro)
                                                {
                                                    echo '<span class="subscribers_status_miсro">микро</span>';
                                                }
                                                                                    
                                                if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_average">средний</span>';
                                                }

                                                if ($subscribers > $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_big">крупный</span>';
                                                }   
                                            ?>
                                        </span> 
                                    </div>
                                              
                                </td>

                                <!-- Охват -->
                                <td class="funner_table_td_common funner_table_td_coverage collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                   
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_agreed_creative->id, 'subscribers' => $subscribers])
                                                ->all();

                                            if ($coverages_db)
                                            {
                                                foreach ($coverages_db as $coverages)
                                                {
                                                    echo '<span class="funner_coverage">'.$coverages->coverage.'</span>';

                                                    // Прогноз охвата
                                                    $grade_coverage = substr($subscribers / $coverages->coverage, 0, 1);

                                                    if ($grade_coverage > 0 && intval($grade_coverage))
                                                    {
                                                        echo '<span class="funner_percent_coverage_green"> > '.$grade_coverage.'%</span>';
                                                    } else {
                                                        echo '<span class="funner_percent_coverage_red"> <'.$grade_coverage.'%</span>';
                                                    }
                                                }
                                            } else { echo '-'; }
                                        ?>
                                    </div>
                                            
                                </td>
                                
                                <!-- Цена -->
                                <td class="funner_table_td_common funner_table_td_price collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                 
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                    ->one();

                                                if ($integration_cost_db)
                                                {
                                                    foreach ($integration_cost_db as $integration_cost)
                                                    {
                                                        echo $integration_cost;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                               
                                </td>

                                <!-- Формат -->
                                <td class="funner_table_td_common funner_table_td_format collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                  
                                    <div> 
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                    ->one();

                                                if ($format_db)
                                                {
                                                    foreach ($format_db as $format)
                                                    {
                                                        echo $format;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <!-- CPM -->
                                <td class="funner_table_td_common funner_table_td_cpm collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_agreed_creative->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_agreed_creative->id ?>">
                                                   
                                    <div> 
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                    ->one();

                                                if ($cpm_db)
                                                {
                                                    foreach ($cpm_db as $cpm)
                                                    {
                                                        echo $cpm;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <td class="funner_table_td_common work_funner_td_close_right">
                                    <div class="checkbox my-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2" name="pending_publication[<?=$bloggers_agreed_creative->id;?>]">
                                            <label class="custom-control-label" for="customCheck02"></label>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                                
                            <!-- Креативы для Креативы на согласовании -->
                            <th colspan="10">

                                <div id="collapse<?=$bloggers_agreed_creative->id ?>" class="collapse" aria-labelledby="heading<?=$bloggers_agreed_creative->id ?>" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="work_creatives">
                                                                        
                                            <? foreach ($creative_db as $creative) { ?>
                                                <? if ($creative->id_blogger == $bloggers_agreed_creative->id) { ?>

                                                    <div class="work_creatives_skin">

                                                        <div class="d-flex mr-3 work_creative_left">
                                                            
                                                            <?php

                                                                // Если это фото
                                                                if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                { ?>
                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                        <img src="<?=$creative->media_link?>" alt="">
                                                                    </a>
                                                                <? }
                                                                else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                { ?>
                                                                    <div>
                                                                        <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                            <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                        </a>
                                                                    </div>
                                                                <?php
                                                                }
                                                                else { 
                                                                    echo 'Ошибка! Кретив не найден.';
                                                                }
                                                            ?>

                                                            <div class="work_creative_btn">

                                                                <?php
                                                                    switch ($creative->status_agreed_klient) {
                                                                        case '1':
                                                                            echo '<span class="creative_btn_approved">Одобрено</span>';
                                                                            break;

                                                                        case '2':
                                                                            echo '<span class="creative_btn_rejected">Отказ</span>';
                                                                            break;
                                                                        
                                                                        default:
                                                                            echo Html::submitButton('Да', [
                                                                                'name'  => 'agreed_id_creative_btn',
                                                                                'value' => $creative->id,
                                                                                'class' => 'btn btn-agreed'
                                                                            ]);

                                                                            echo Html::submitButton('Нет', [
                                                                                'name'  => 'rejected_id_creative_btn',
                                                                                'value' => $creative->id,
                                                                                'class' => 'btn btn-rejected'
                                                                            ]);
                                                                            break;
                                                                    }
                                                                ?>

                                                            </div>

                                                        </div>

                                                        <div class="work_creative_right">
                                                            <div class="work_creative_right_header">
                                                                <h5 class="mt-0">текст к публикации:</h5>

                                                                <div class="work_creative_left_header">
                                                                    <span class="work_creative_publication"><?=$creative->format ?></span>
                                                                    <a href="/creative/update?id=<?=$creative->id ?>&id_project=<?=Yii::$app->request->get('project')?>" class="btn_creative_work">редактировать</a>
                                                                </div>
                                                            </div>

                                                            <div class="work_creative_description">
                                                                <p><?=$creative->description ?></p>
                                                            </div>

                                                            <div class="work_coment_main">
                                                                <h5 class="mt-0">Комментарий по креативу:</h5>

                                                                <div class="work_creative_left_header">

                                                                    <?
                                                                        // Считаем общее кол-во коментов у креатива
                                                                        $creative_comments_count = СreativesСommentsForm::find()
                                                                            ->Where(['id_creative' => $creative->id])
                                                                            ->count();
                                                                    ?>

                                                                    <!-- Выводим кнопку "комментарии" -->
                                                                    <? if ($creative_comments_count > 0) { ?>
                                                                        <a class="btn_creative_work popup-open_<?=$creative->id;?>" href="#">комментарии</a>
                                                                    <? } else { ?>
                                                                        <a class="btn_creative_work work_creative_btn_deactivated">комментарии</a>
                                                                    <? } ?>

                                                                    <!-- Popup Comments -->
                                                                    <div class="popup_comments_fade popup_comments_fade_<?=$creative->id;?>">
                                                                        <div class="popup_comments popup_<?=$creative->id;?>">

                                                                            <div class="popup_com_header">
                                                                                <div class="popup_com_header_title">Все комментарии по креативу</div>
                                                                                <a class="popup_comments_close" href="#">×</a>
                                                                            </div>

                                                                            <div class="popup_com_head">
                                                                                <div class="popup_com_blogger">
                                                                                    <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                                                                    <div class="popup_com_blogger_info">
                                                                                        <div class="popup_com_blogger_name"><?=$bloggers_agreed_creative->name; ?></div>
                                                                                        <div class="popup_com_meta">
                                                                                            <span>
                                                                                                <?php
                                                                                                    // Выводим img платформы
                                                                                                    $pltforms_img_blogger = PlatformForm::find()
                                                                                                        ->select('img')
                                                                                                        ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                                                                        ->Where(['data_platforms.id_blogger' => $bloggers_agreed_creative->id])
                                                                                                        ->one();

                                                                                                    echo '<img src='.$pltforms_img_blogger->img.' class="popup_com_img_blogger" alt="">';
                                                                               
                                                                                                    // Выводим макс. кол-во подписчиков
                                                                                                    $subscribers = DataPlatformsForm::find()
                                                                                                        ->Where(['id_blogger' => $bloggers_agreed_creative->id])
                                                                                                        ->max('subscribers');

                                                                                                    // Выводим данные платформ
                                                                                                    $data_platforms = DataPlatformsForm::find()
                                                                                                        ->Where(['id_blogger' => $bloggers_agreed_creative->id, 'subscribers' => $subscribers])
                                                                                                        ->all();

                                                                                                    foreach ($data_platforms as $data_platform)
                                                                                                    {
                                                                                                        echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                                                                    }
                                                                                                ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <img src="/web/images/comment_icon.png" class="popup_com_icon">
                                                                                </div>
                                                                                <div class="popup_com_creative">
                                                                                    <div class="popup_com_creative_img">
                                                                                        <?php
                                                                                            // Если это фото
                                                                                            if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                                            { ?>
                                                                                                <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                    <img src="<?=$creative->media_link?>" alt="">
                                                                                                </a>
                                                                                            <? }
                                                                                            else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                                            { ?>
                                                                                                <div>
                                                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                        <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                                                    </a>
                                                                                                </div>
                                                                                            <?php
                                                                                            }
                                                                                            else { 
                                                                                                echo 'Ошибка! Кретив не найден.';
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="popup_com_creative_content">
                                                                                        <div class="popup_com_creative_content_header">
                                                                                            <h5>текст к публикации:</h5>
                                                                                            <span><?=$creative->format ?></span>
                                                                                        </div>
                                                                                        
                                                                                        <p><?=$creative->description ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?
                                                                                $creative_comments_db = СreativesСommentsForm::find()
                                                                                    ->Where([
                                                                                        'id_creative' => $creative->id
                                                                                    ])
                                                                                    ->orderBy('id desc')
                                                                                    ->all();
                                                                            ?>

                                                                            <div class="comment_main">

                                                                                <? foreach ($creative_comments_db as $creative_comments) { ?>
                                                                                    <? if ($creative_comments->id_creative == $creative->id) { ?>
                                                                                    
                                                                                    <div class="comment_item">
                                                                                        <div class="comment_item_header">
                                                                                            <span class="comment_item_txt">Отправленно:</span>
                                                                                            <span class="comment_item_create_data"><?=$creative_comments->create_date ?></span>
                                                                                        </div>

                                                                                        <div class="comment_content">
                                                                                            <?php
                                                                                                // Выводим пользователя который оставил комментарий
                                                                                                $user_comment_db = User::find()
                                                                                                    ->Where(['id' => $creative_comments->create_user_id])
                                                                                                    ->orderBy('id desc')
                                                                                                    ->all();
                                                                                            ?>
                                                                                            
                                                                                            <? foreach ($user_comment_db as $user_comment) { ?>

                                                                                                <? if ($user_comment->role == 'klient') { ?>

                                                                                                    <div class="comment_user_avatar"><img src="<?=$user_comment->avatar ?>"></div>

                                                                                                <? } else { ?>

                                                                                                    <div class="comment_user_avatar"><img src="/web/images/logo.png"></div>

                                                                                                <? } ?>
                                                                                            <? } ?>

                                                                                            <div class="comment_text"><?=$creative_comments->comment ?></div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <? } ?>
                                                                                <? } ?>
                                                                            </div>

                                                                        </div>      
                                                                    </div> <!-- // popup_comments_fade -->

                                                                    <script>
                                                                        $(document).ready(function($) {   

                                                                            console.log( "ready!" );

                                                                            $('.popup-open_<?=$creative->id;?>').click(function() {
                                                                                $('.popup_comments_fade_<?=$creative->id;?>').fadeIn();
                                                                                return false;
                                                                            }); 
                                                                            
                                                                            $('.popup_comments_close').click(function() {
                                                                                $(this).parents('.popup_comments_fade_<?=$creative->id;?>').fadeOut();
                                                                                return false;
                                                                            });     

                                                                            $(document).keydown(function(e) {
                                                                                if (e.keyCode === 27) {
                                                                                    e.stopPropagation();
                                                                                    $('.popup-fade_<?=$creative->id;?>').fadeOut();
                                                                                }
                                                                            });
                                                                            
                                                                            $('.popup-fade').click(function(e) {
                                                                                if ($(e.target).closest('.popup_<?=$creative->id;?>').length == 0) {
                                                                                    $(this).fadeOut();                  
                                                                                }
                                                                            }); 
                                                                        });
                                                                    </script>
                                                                    <!-- // Popup Comments // -->

                                                                    <?=Html::submitButton('Отправить', [
                                                                        'name'  => 'comment_id_creative_btn',
                                                                        'value' => $creative->id,
                                                                        'class' => 'btn_creative_work'
                                                                    ]); ?>

                                                                </div>
                                                                    
                                                                <?
                                                                    // Выводим последний комментарий 
                                                                    $creative_comment_one = СreativesСommentsForm::find()
                                                                        ->Where([
                                                                            'id_creative' => $creative->id
                                                                        ])
                                                                        ->orderBy('id desc')
                                                                        ->one();
                                                                ?>
                                                          
                                                                <? if ($creative_comments_count > 0) { ?>
                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="<?=$creative_comment_one->comment ?>" name="comment_creative_<?=$creative->id ?>"></textarea>
                                                                <? } else { ?>
                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментариев нет" name="comment_creative_<?=$creative->id ?>"></textarea>
                                                                <? } ?>
                                                            </div>
                                                        </div>

                                                    </div> <!-- end work_creative_neutral -->                                    

                                                <? } ?>

                                            <? } ?>

                                        </div> <!-- end work_creatives -->

                                    </div> <!-- end card-body -->

                                </div> <!-- end Креативы -->

                            </th>

                        <? } // foreach ?>

                    </tbody>

                <?php ActiveForm::end(); ?>

            <? } // $bloggers_agreed_creative_db ?>

                <tbody>

                    <? if ($bloggers_pending_publication_db) { ?>
                        
                        <th colspan="9" class="funner_th_title_work">Ожидает публикации</th>

                        <th>
                            <?php $form = ActiveForm::begin(); ?>

                            <?=Html::submitButton('согласовать', [
                                //'name'  => 'publication_confirmation',
                                'name'    => 'btn',
                                'value'   => 'publication_confirmation',
                                'class'   => 'btn-approve'
                            ]); ?>

                        </th>

                        <?php foreach ($bloggers_pending_publication_db as $bloggers_pending_publication) { ?>
                
                            <tr class="funner_table_body">
                                
                                <!-- id Блогера -->
                                <td class="funner_work_items_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">

                                    <div class="agreed_items_div"></div>

                                </td>
                                
                                <!-- Аватар блогера -->
                                <td class="funner_table_td_common work_table_td_avatar collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                 
                                    <div class="agreed_table_avatar_div">
                                        <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                    </div>
                                                
                                </td>

                                <!-- Аккаунт -->
                                <td class="funner_table_td_common agreed_table_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                  
                                    <div class="agreed_table_div_title"><?=$bloggers_pending_publication->name;?>

                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="mdi mdi-settings"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                                <a class="dropdown-item" href="/blogger/view/<?=$bloggers_pending_publication->id;?>">Посмотреть</a>
                                                <a class="dropdown-item" href="/blogger/update/<?=$bloggers_pending_publication->id;?>">Редактировать</a>
                                                <!-- <a class="dropdown-item" href="/blogger/delete/<?=$bloggers_pending_publication->id;?>"
                                                    >Удалить</a> -->
                                            </div>
                                        </div>

                                        <span>
                                            <?php
                                                // Выводим img платформы
                                                $pltforms_img_blogger = PlatformForm::find()
                                                    ->select('img')
                                                    ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                    ->Where(['data_platforms.id_blogger' => $bloggers_pending_publication->id])
                                                    ->one();

                                                echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                                // Выводим макс. кол-во подписчиков
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                    ->max('subscribers');

                                                // Выводим данные платформ
                                                $data_platforms = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_pending_publication->id, 'subscribers' => $subscribers])
                                                    ->all();

                                                foreach ($data_platforms as $data_platform)
                                                {
                                                    echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                }
                                            ?>
                                        </span>
                                    </div>
                                                  
                                </td>

                                <!-- Категория -->
                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers_pending_publication->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                      
                                            <div style="color: #b9b9ba;">
                                                <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                            </div>
                                                      
                                    </td>
                                <? } ?>
                                       
                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_subscribers_skine collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                  
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                ->max('subscribers');
                                        ?>

                                        <span class="funner_table_subscribers_skine"><?=$subscribers ?></span>
                                        <span class="funner_table_subscribers_statys_skine">
                                            <?php 
                                                if ($subscribers < $coverage_micro)
                                                {
                                                    echo '<span class="subscribers_status_miсro">микро</span>';
                                                }
                                                                                    
                                                if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_average">средний</span>';
                                                }

                                                if ($subscribers > $coverage_average)
                                                {
                                                    echo '<span class="subscribers_status_big">крупный</span>';
                                                }   
                                            ?>
                                        </span> 
                                    </div>
                                              
                                </td>

                                <!-- Охват -->
                                <td class="funner_table_td_common funner_table_td_coverage collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                   
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_pending_publication->id, 'subscribers' => $subscribers])
                                                ->all();

                                            if ($coverages_db)
                                            {
                                                foreach ($coverages_db as $coverages)
                                                {
                                                    echo '<span class="funner_coverage">'.$coverages->coverage.'</span>';

                                                    // Прогноз охвата
                                                    $grade_coverage = substr($subscribers / $coverages->coverage, 0, 1);

                                                    if ($grade_coverage > 0 && intval($grade_coverage))
                                                    {
                                                        echo '<span class="funner_percent_coverage_green"> > '.$grade_coverage.'%</span>';
                                                    } else {
                                                        echo '<span class="funner_percent_coverage_red"> <'.$grade_coverage.'%</span>';
                                                    }
                                                }
                                            } else { echo '-'; }
                                        ?>
                                    </div>
                                            
                                </td>
                                
                                <!-- Цена -->
                                <td class="funner_table_td_common funner_table_td_price collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                 
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                    ->one();

                                                if ($integration_cost_db)
                                                {
                                                    foreach ($integration_cost_db as $integration_cost)
                                                    {
                                                        echo $integration_cost;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                               
                                </td>

                                <!-- Формат -->
                                <td class="funner_table_td_common funner_table_td_format collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                  
                                    <div> 
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                    ->one();

                                                if ($format_db)
                                                {
                                                    foreach ($format_db as $format)
                                                    {
                                                        echo $format;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <!-- CPM -->
                                <td class="funner_table_td_common funner_table_td_cpm collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_pending_publication->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_pending_publication->id ?>">
                                                   
                                    <div> 
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                    ->one();

                                                if ($cpm_db)
                                                {
                                                    foreach ($cpm_db as $cpm)
                                                    {
                                                        echo $cpm;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <td class="funner_table_td_common work_funner_td_close_right">
                                    <div class="checkbox my-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2" name="publication_confirmation[<?=$bloggers_pending_publication->id;?>]">
                                            <label class="custom-control-label" for="customCheck02"></label>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                                
                            <!-- Креативы для Ожидает публикации -->
                            <th colspan="10">

                                <div id="collapse<?=$bloggers_pending_publication->id ?>" class="collapse" aria-labelledby="heading<?=$bloggers_pending_publication->id ?>" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="work_creatives">
                                                                        
                                            <? foreach ($creative_db as $creative) { ?>
                                                <? if ($creative->id_blogger == $bloggers_pending_publication->id) { ?>

                                                    <? if ($creative->status_agreed_klient == 1) { ?>

                                                        <div class="work_creatives_skin">

                                                            <div class="d-flex mr-3 work_creative_left">
                                                                
                                                                <?php

                                                                    // Если это фото
                                                                    if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                    { ?>
                                                                        <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                            <img src="<?=$creative->media_link?>" alt="">
                                                                        </a>
                                                                    <? }
                                                                    else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                    { ?>
                                                                        <div>
                                                                            <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                            </a>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    else { 
                                                                        echo 'Ошибка! Кретив не найден.';
                                                                    }
                                                                ?>

                                                                <div class="work_creative_btn">

                                                                    <?php
                                                                        if ($creative->status_agreed_klient == 1)
                                                                        {
                                                                            echo '<span class="creative_btn_approved">Одобрено</span>';
                                                                        }
                                                                    ?>

                                                                </div>

                                                            </div>

                                                            <div class="work_creative_right">
                                                                <div class="work_creative_right_header">
                                                                    <h5 class="mt-0">текст к публикации:</h5>

                                                                    <div class="work_creative_left_header">
                                                                        <span class="work_creative_publication"><?=$creative->format ?></span>
                                                                        <a href="/creative/update?id=<?=$creative->id ?>&id_project=<?=Yii::$app->request->get('project')?>" class="btn_creative_work">редактировать</a>
                                                                    </div>
                                                                </div>

                                                                <div class="work_creative_description">
                                                                    <p><?=$creative->description ?></p>
                                                                </div>

                                                                <div class="work_coment_main">
                                                                    <h5 class="mt-0">Комментарий по креативу:</h5>

                                                                    <div class="work_creative_left_header">

                                                                        <?
                                                                            // Считаем общее кол-во коментов у креатива
                                                                            $creative_comments_count = СreativesСommentsForm::find()
                                                                                ->Where(['id_creative' => $creative->id])
                                                                                ->count();
                                                                        ?>

                                                                        <!-- Выводим кнопку "комментарии" -->
                                                                        <? if ($creative_comments_count > 0) { ?>
                                                                            <a class="btn_creative_work popup-open_<?=$creative->id;?>" href="#">комментарии</a>
                                                                        <? } else { ?>
                                                                            <a class="btn_creative_work work_creative_btn_deactivated">комментарии</a>
                                                                        <? } ?>

                                                                        <!-- Popup Comments -->
                                                                        <div class="popup_comments_fade popup_comments_fade_<?=$creative->id;?>">
                                                                            <div class="popup_comments popup_<?=$creative->id;?>">

                                                                                <div class="popup_com_header">
                                                                                    <div class="popup_com_header_title">Все комментарии по креативу</div>
                                                                                    <a class="popup_comments_close" href="#">×</a>
                                                                                </div>

                                                                                <div class="popup_com_head">
                                                                                    <div class="popup_com_blogger">
                                                                                        <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                                                                        <div class="popup_com_blogger_info">
                                                                                            <div class="popup_com_blogger_name"><?=$bloggers_pending_publication->name; ?></div>
                                                                                            <div class="popup_com_meta">
                                                                                                <span>
                                                                                                    <?php
                                                                                                        // Выводим img платформы
                                                                                                        $pltforms_img_blogger = PlatformForm::find()
                                                                                                            ->select('img')
                                                                                                            ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                                                                            ->Where(['data_platforms.id_blogger' => $bloggers_pending_publication->id])
                                                                                                            ->one();

                                                                                                        echo '<img src='.$pltforms_img_blogger->img.' class="popup_com_img_blogger" alt="">';
                                                                                   
                                                                                                        // Выводим макс. кол-во подписчиков
                                                                                                        $subscribers = DataPlatformsForm::find()
                                                                                                            ->Where(['id_blogger' => $bloggers_pending_publication->id])
                                                                                                            ->max('subscribers');

                                                                                                        // Выводим данные платформ
                                                                                                        $data_platforms = DataPlatformsForm::find()
                                                                                                            ->Where(['id_blogger' => $bloggers_pending_publication->id, 'subscribers' => $subscribers])
                                                                                                            ->all();

                                                                                                        foreach ($data_platforms as $data_platform)
                                                                                                        {
                                                                                                            echo '<span class="popup_com_blogger_account"><a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                                                                        }
                                                                                                    ?>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <img src="/web/images/comment_icon.png" class="popup_com_icon">
                                                                                    </div>
                                                                                    <div class="popup_com_creative">
                                                                                        <div class="popup_com_creative_img">
                                                                                            <?php
                                                                                                // Если это фото
                                                                                                if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                                                { ?>
                                                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                        <img src="<?=$creative->media_link?>" alt="">
                                                                                                    </a>
                                                                                                <? }
                                                                                                else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                                                { ?>
                                                                                                    <div>
                                                                                                        <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                            <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                                                        </a>
                                                                                                    </div>
                                                                                                <?php
                                                                                                }
                                                                                                else { 
                                                                                                    echo 'Ошибка! Кретив не найден.';
                                                                                                }
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="popup_com_creative_content">
                                                                                            <div class="popup_com_creative_content_header">
                                                                                                <h5>текст к публикации:</h5>
                                                                                                <span><?=$creative->format ?></span>
                                                                                            </div>
                                                                                            
                                                                                            <p><?=$creative->description ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?
                                                                                    $creative_comments_db = СreativesСommentsForm::find()
                                                                                        ->Where([
                                                                                            'id_creative' => $creative->id
                                                                                        ])
                                                                                        ->orderBy('id desc')
                                                                                        ->all();
                                                                                ?>

                                                                                <div class="comment_main">

                                                                                    <? foreach ($creative_comments_db as $creative_comments) { ?>
                                                                                        <? if ($creative_comments->id_creative == $creative->id) { ?>
                                                                                        
                                                                                        <div class="comment_item">
                                                                                            <div class="comment_item_header">
                                                                                                <span class="comment_item_txt">Отправленно:</span>
                                                                                                <span class="comment_item_create_data"><?=$creative_comments->create_date ?></span>
                                                                                            </div>

                                                                                            <div class="comment_content">
                                                                                                <?php
                                                                                                    // Выводим пользователя который оставил комментарий
                                                                                                    $user_comment_db = User::find()
                                                                                                        ->Where(['id' => $creative_comments->create_user_id])
                                                                                                        ->orderBy('id desc')
                                                                                                        ->all();
                                                                                                ?>
                                                                                                
                                                                                                <? foreach ($user_comment_db as $user_comment) { ?>

                                                                                                    <? if ($user_comment->role == 'klient') { ?>

                                                                                                        <div class="comment_user_avatar"><img src="<?=$user_comment->avatar ?>"></div>

                                                                                                    <? } else { ?>

                                                                                                        <div class="comment_user_avatar"><img src="/web/images/logo.png"></div>

                                                                                                    <? } ?>
                                                                                                <? } ?>

                                                                                                <div class="comment_text"><?=$creative_comments->comment ?></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <? } ?>
                                                                                    <? } ?>
                                                                                </div>

                                                                            </div>      
                                                                        </div> <!-- // popup_comments_fade -->

                                                                        <script>
                                                                            $(document).ready(function($) {   

                                                                                console.log( "ready!" );

                                                                                $('.popup-open_<?=$creative->id;?>').click(function() {
                                                                                    $('.popup_comments_fade_<?=$creative->id;?>').fadeIn();
                                                                                    return false;
                                                                                }); 
                                                                                
                                                                                $('.popup_comments_close').click(function() {
                                                                                    $(this).parents('.popup_comments_fade_<?=$creative->id;?>').fadeOut();
                                                                                    return false;
                                                                                });     

                                                                                $(document).keydown(function(e) {
                                                                                    if (e.keyCode === 27) {
                                                                                        e.stopPropagation();
                                                                                        $('.popup-fade_<?=$creative->id;?>').fadeOut();
                                                                                    }
                                                                                });
                                                                                
                                                                                $('.popup-fade').click(function(e) {
                                                                                    if ($(e.target).closest('.popup_<?=$creative->id;?>').length == 0) {
                                                                                        $(this).fadeOut();                  
                                                                                    }
                                                                                }); 
                                                                            });
                                                                        </script>
                                                                        <!-- // Popup Comments // -->

                                                                    </div>
                                                                        
                                                                    <?
                                                                        // Выводим последний комментарий 
                                                                        $creative_comment_one = СreativesСommentsForm::find()
                                                                            ->Where([
                                                                                'id_creative' => $creative->id
                                                                            ])
                                                                            ->orderBy('id desc')
                                                                            ->one();
                                                                    ?>
                                                              
                                                                    <? if ($creative_comments_count > 0) { ?>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="<?=$creative_comment_one->comment ?>" disabled></textarea>
                                                                    <? } else { ?>
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментариев нет" disabled></textarea>
                                                                    <? } ?>
                                                                </div>
                                                            </div>

                                                        </div> <!-- end work_creative_neutral -->                                    

                                                    <? } ?>

                                                <? } ?>

                                            <? } ?>

                                        </div> <!-- end work_creatives -->

                                    </div> <!-- end card-body -->

                                </div> <!-- end Креативы -->

                            </th>

                        <? } // foreach ?>

                    </tbody>

                <?php ActiveForm::end(); ?>

            <? } // $bloggers_agreed_creative_db ?>


            <? if ($bloggers_confirmed_db) { ?>

                <tbody>

                    <th colspan="9" class="funner_th_title_work">Размещение подтверждено</th>
                    
                        <?php foreach ($bloggers_confirmed_db as $bloggers_confirmed) { ?>
                
                            <tr class="long_list_table_body body__work">
                                            
                                <!-- id блогера -->
                                <td class="funner_work_items_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                    
                                    <div class="agreed_items_div"></div>
                                                    
                                </td>

                                <!-- Изображение блогера -->
                                <td class="funner_table_td_common work_table_td_avatar collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                 
                                    <div class="agreed_table_avatar_div">
                                        <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                    </div>
                                                
                                </td>

                                <!-- Аккаунт -->
                                <td class="funner_table_td_common agreed_table_td collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                  
                                    <div class="agreed_table_div_title"><?=$bloggers_confirmed->name;?>

                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="mdi mdi-settings"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                                <a class="dropdown-item" href="/blogger/view/<?=$bloggers_confirmed->id;?>" >Посмотреть</a>
                                                <a class="dropdown-item" href="/blogger/update/<?=$bloggers_confirmed->id;?>" >Редактировать</a>
                                                <!-- <a class="dropdown-item" href="/blogger/delete/<?=$bloggers_confirmed->id;?>">Удалить</a> -->
                                            </div>
                                        </div>

                                        <span>
                                            <?php
                                                // Выводим img платформы
                                                $pltforms_img_blogger = PlatformForm::find()
                                                    ->select('img')
                                                    ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                    ->Where(['data_platforms.id_blogger' => $bloggers_confirmed->id])
                                                    ->one();

                                                echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                                // Выводим макс. кол-во подписчиков
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                    ->max('subscribers');

                                                // Выводим данные платформ
                                                $data_platforms = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_confirmed->id, 'subscribers' => $subscribers])
                                                    ->all();

                                                foreach ($data_platforms as $data_platform)
                                                {
                                                    echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                }
                                            ?>
                                        </span>
                                    </div>
                                                  
                                </td>

                                <!-- Категория -->
                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers_confirmed->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                      
                                        <div style="color: #b9b9ba;">
                                            <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                        </div>
                                                      
                                    </td>
                                <? } ?>
                                            
                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_coverage collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                   
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_confirmed->id, 'subscribers' => $subscribers])
                                                ->all();

                                            if ($coverages_db)
                                            {
                                                foreach ($coverages_db as $coverages)
                                                {
                                                    echo '<span class="funner_coverage">'.$coverages->coverage.'</span>';

                                                    // Прогноз охвата
                                                    $grade_coverage = substr($subscribers / $coverages->coverage, 0, 1);

                                                    if ($grade_coverage > 0 && intval($grade_coverage))
                                                    {
                                                        echo '<span class="funner_percent_coverage_green"> > '.$grade_coverage.'%</span>';
                                                    } else {
                                                        echo '<span class="funner_percent_coverage_red"> <'.$grade_coverage.'%</span>';
                                                    }
                                                }
                                            } else { echo '-'; }
                                        ?>
                                    </div>
                                            
                                </td>

                                <!-- Охват -->
                                <td class="funner_table_td_common funner_table_td_coverage collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                   
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_confirmed->id, 'subscribers' => $subscribers])
                                                ->all();

                                            if ($coverages_db)
                                            {
                                                foreach ($coverages_db as $coverages)
                                                {
                                                    echo '<span class="funner_coverage">'.$coverages->coverage.'</span>';

                                                    // Прогноз охвата
                                                    $grade_coverage = substr($subscribers / $coverages->coverage, 0, 1);

                                                    if ($grade_coverage > 0 && intval($grade_coverage))
                                                    {
                                                        echo '<span class="funner_percent_coverage_green"> > '.$grade_coverage.'%</span>';
                                                    } else {
                                                        echo '<span class="funner_percent_coverage_red"> <'.$grade_coverage.'%</span>';
                                                    }
                                                }
                                            } else { echo '-'; }
                                        ?>
                                    </div>
                                            
                                </td>

                                <!-- Цена -->
                                <td class="funner_table_td_common funner_table_td_price collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                 
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                    ->one();

                                                if ($integration_cost_db)
                                                {
                                                    foreach ($integration_cost_db as $integration_cost)
                                                    {
                                                        echo $integration_cost;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                               
                                </td>

                                <!-- Формат -->
                                <td class="funner_table_td_common funner_table_td_format collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                  
                                    <div> 
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                    ->one();

                                                if ($format_db)
                                                {
                                                    foreach ($format_db as $format)
                                                    {
                                                        echo $format;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <!-- CPM -->
                                <td class="funner_table_td_common funner_table_td_cpm collapsed collapsed_cursor" data-toggle="collapse" data-target="#collapse<?=$bloggers_confirmed->id ?>" aria-expanded="false" aria-controls="collapse<?=$bloggers_confirmed->id ?>">
                                                   
                                    <div> 
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                    ->one();

                                                if ($cpm_db)
                                                {
                                                    foreach ($cpm_db as $cpm)
                                                    {
                                                        echo $cpm;
                                                    }
                                                } else { echo '-'; }
                                            ?>
                                        </span>
                                    </div>
                                                 
                                </td>

                                <td class="funner_table_td_common work_funner_td_close_right"></td>

                            </tr>
               
                            <!-- Креативы для Размещение подтверждено -->
                            <th colspan="10">

                                <div id="collapse<?=$bloggers_confirmed->id ?>" class="collapse" aria-labelledby="heading<?=$bloggers_confirmed->id ?>" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="work_creatives">
                                                                        
                                            <? foreach ($creative_agreed_db as $creative) { ?>
                                                <? if ($creative->id_blogger == $bloggers_confirmed->id) { ?>

                                                    <div class="work_creatives_skin">

                                                        <div class="d-flex mr-3 work_creative_left">
                                                            
                                                            <?php

                                                                // Если это фото
                                                                if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                { ?>
                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                        <img src="<?=$creative->media_link?>" alt="">
                                                                    </a>
                                                                <? }
                                                                else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                { ?>
                                                                    <div>
                                                                        <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                            <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                        </a>
                                                                    </div>
                                                                <?php
                                                                }
                                                                else { 
                                                                    echo 'Ошибка! Кретив не найден.';
                                                                }
                                                            ?>

                                                            <div class="work_creative_btn">

                                                                <?php
                                                                    if ($creative->status_agreed_klient == 1)
                                                                    {
                                                                        echo '<span class="creative_btn_approved">Одобрено</span>';
                                                                    }
                                                                ?>

                                                            </div>
                                                        </div>

                                                        <div class="work_creative_right">
                                                            <div class="work_creative_right_header">
                                                                <h5 class="mt-0">текст к публикации:</h5>

                                                                <div class="work_creative_left_header">
                                                                    <span class="work_creative_publication"><?=$creative->format ?></span>
                                                                    <a href="/creative/update?id=<?=$creative->id ?>&id_project=<?=Yii::$app->request->get('project')?>" class="btn_creative_work">редактировать</a>
                                                                </div>
                                                            </div>

                                                            <div class="work_creative_description">
                                                                <p><?=$creative->description ?></p>
                                                            </div>

                                                            <div class="work_coment_main">
                                                                <h5 class="mt-0">Комментарий по креативу:</h5>

                                                                <div class="work_creative_left_header">

                                                                    <a class="btn_creative_work popup-open_<?=$creative->id;?>" href="#">комментарии</a>

                                                                    <!-- Popup Comments -->
                                                                    <div class="popup_comments_fade popup_comments_fade_<?=$creative->id;?>">
                                                                        <div class="popup_comments popup_<?=$creative->id;?>">

                                                                            <div class="popup_com_header">
                                                                                <div class="popup_com_header_title">Все комментарии по креативу</div>
                                                                                <a class="popup_comments_close" href="#">×</a>
                                                                            </div>

                                                                            <div class="popup_com_head">
                                                                                <div class="popup_com_blogger">
                                                                                    <img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1">
                                                                                    <div class="popup_com_blogger_info">
                                                                                        <div class="popup_com_blogger_name"><?=$bloggers_confirmed->name; ?></div>
                                                                                        <div class="popup_com_meta">
                                                                                            <span>
                                                                                                <?php
                                                                                                    // Выводим img платформы
                                                                                                    $pltforms_img_blogger = PlatformForm::find()
                                                                                                        ->select('img')
                                                                                                        ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                                                                        ->Where(['data_platforms.id_blogger' => $bloggers_confirmed->id])
                                                                                                        ->one();

                                                                                                    echo '<img src='.$pltforms_img_blogger->img.' class="popup_com_img_blogger" alt="">';
                                                                               
                                                                                                    // Выводим макс. кол-во подписчиков
                                                                                                    $subscribers = DataPlatformsForm::find()
                                                                                                        ->Where(['id_blogger' => $bloggers_confirmed->id])
                                                                                                        ->max('subscribers');

                                                                                                    // Выводим данные платформ
                                                                                                    $data_platforms = DataPlatformsForm::find()
                                                                                                        ->Where(['id_blogger' => $bloggers_confirmed->id, 'subscribers' => $subscribers])
                                                                                                        ->all();

                                                                                                    foreach ($data_platforms as $data_platform)
                                                                                                    {
                                                                                                        echo '<span class="popup_com_blogger_account"><a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a></span>';
                                                                                                    }
                                                                                                ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <img src="/web/images/comment_icon.png" class="popup_com_icon">
                                                                                </div>
                                                                                <div class="popup_com_creative">
                                                                                        <div class="popup_com_creative_img">
                                                                                            <?php
                                                                                                // Если это фото
                                                                                                if (array_intersect(explode('.', $creative->media_link), $format_img[0]))
                                                                                                { ?>
                                                                                                    <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                        <img src="<?=$creative->media_link?>" alt="">
                                                                                                    </a>
                                                                                                <? }
                                                                                                else if (array_intersect(explode('.', $creative->media_link), $format_video[0]))
                                                                                                { ?>
                                                                                                    <div>
                                                                                                        <a data-fancybox="" data-small-btn="true" href="<?=$creative->media_link ?>">
                                                                                                            <img class="card-img-top img-fluid" src="/web/images/video.png" width="140px">
                                                                                                        </a>
                                                                                                    </div>
                                                                                                <?php
                                                                                                }
                                                                                                else { 
                                                                                                    echo 'Ошибка! Кретив не найден.';
                                                                                                }
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="popup_com_creative_content">
                                                                                            <div class="popup_com_creative_content_header">
                                                                                                <h5>текст к публикации:</h5>
                                                                                                <span><?=$creative->format ?></span>
                                                                                            </div>
                                                                                            
                                                                                            <p><?=$creative->description ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                <div class="popup_com_creative"></div>
                                                                            </div>
                                                                            <?
                                                                                $creative_comments_db = СreativesСommentsForm::find()
                                                                                    ->Where([
                                                                                        'id_creative' => $creative->id,
                                                                                    ])
                                                                                    ->orderBy('id desc')
                                                                                    ->all();
                                                                            ?>

                                                                            <div class="comment_main">

                                                                                <? foreach ($creative_comments_db as $creative_comments) { ?>
                                                                                    <? if ($creative_comments->id_creative == $creative->id) { ?>
                                                                                    
                                                                                    <div class="comment_item">
                                                                                        <div class="comment_item_header">
                                                                                            <span class="comment_item_txt">Отправленно:</span>
                                                                                            <span class="comment_item_create_data"><?=$creative_comments->create_date ?></span>
                                                                                        </div>
                                                                                        <div class="comment_content">
                                                                                            <?php
                                                                                                // Выводим пользователя который оставил комментарий
                                                                                                $user_comment_db = User::find()
                                                                                                    ->Where(['id' => $creative_comments->create_user_id])
                                                                                                    ->orderBy('id desc')
                                                                                                    ->all();
                                                                                            ?>
                                                                                                    
                                                                                            <? foreach ($user_comment_db as $user_comment) { ?>

                                                                                                <? if ($user_comment->role == 'klient') { ?>

                                                                                                    <div class="comment_user_avatar"><img src="<?=$user_comment->avatar ?>"></div>

                                                                                                <? } else { ?>

                                                                                                    <div class="comment_user_avatar"><img src="/web/images/logo.png"></div>

                                                                                                <? } ?>
                                                                                            <? } ?>

                                                                                            <div class="comment_text"><?=$creative_comments->comment ?></div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <? } ?>
                                                                                <? } ?>
                                                                            </div>
                                                                        </div>      
                                                                    </div>

                                                                    <script>
                                                                        $(document).ready(function($) {
                                                                            $('.popup-open_<?=$creative->id;?>').click(function() {
                                                                                $('.popup_comments_fade_<?=$creative->id;?>').fadeIn();
                                                                                return false;
                                                                            }); 
                                                                            
                                                                            $('.popup_comments_close').click(function() {
                                                                                $(this).parents('.popup_comments_fade_<?=$creative->id;?>').fadeOut();
                                                                                return false;
                                                                            });     

                                                                            $(document).keydown(function(e) {
                                                                                if (e.keyCode === 27) {
                                                                                    e.stopPropagation();
                                                                                    $('.popup-fade_<?=$creative->id;?>').fadeOut();
                                                                                }
                                                                            });
                                                                            
                                                                            $('.popup-fade').click(function(e) {
                                                                                if ($(e.target).closest('.popup_<?=$creative->id;?>').length == 0) {
                                                                                    $(this).fadeOut();                  
                                                                                }
                                                                            }); 
                                                                        });
                                                                    </script>
                                                                    <!-- // Popup Comments // -->

                                                                    <?
                                                                    // Html::submitButton('Отправить', [
                                                                    //     'name'  => 'comment_id_creative_btn',
                                                                    //     'value' => $creative->id,
                                                                    //     'class' => 'btn_creative_work'
                                                                    // ]); ?>

                                                                </div>
                                                                    
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="<?=$creative_comments->comment ?>" name="comment_creative_<?=$creative->id ?>" disabled></textarea>
                                                                
                                                            </div>
                                                        </div>

                                                    </div> <!-- end work_creative_neutral -->                                    

                                                <? } ?>

                                            <? } ?>

                                        </div> <!-- end work_creatives -->

                                    </div> <!-- end card-body -->

                                </div> <!-- end Креативы -->

                            </th>

                        <? } // foreach ?>

                    </tbody>

                <? } // $bloggers_agreed_creative_db ?>

            </table>

        </div>

    <? } // get project ?>

<? } // get ?>
