<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CategoryForm;
use app\models\DataPlatformsForm;
use app\models\PlatformForm;

$this->title = 'Согласованные';
$this->params['breadcrumbs'][] = $this->title;
?>
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
        <li class="menu-funnel-item item-active">
            <a href="/manager/agreed<?=$get_project?>" class="nav-link">Согласованные</a>
        </li>
        <li class="menu-funnel-item">
            <a href="/manager/work<?=$get_project?>" class="nav-link">В работе</a>
        </li>
    </ul>
</div>

<div class="table-responsive counter_td">
    <?php $form = ActiveForm::begin(); ?>
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
                        <div class="funnel_th_btn_div funner_table_end_right">
                            <?php if (Yii::$app->request->get()) { 
                                echo Html::submitButton(Yii::t('app', 'согласовать'), ['class' => 'btn-approve']);
                            } ?>
                        </div>
                    </th>
                </tr>

            </thead>
            <tbody>
            <? if (Yii::$app->request->get()) { ?>

                <!-- Выводим всех блогеров которые привязанные к клиенту -->
                <?php if(Yii::$app->request->get('project')) { ?>

                    <!-- Выводим нейтральных блогеров -->
                    <? if ($bloggers_neutral_projects_db) { ?>
                        <?php foreach ($bloggers_neutral_projects_db as $bloggers_neutral) { ?>

                            <tr class="funner_table_body">
                                
                                <td class="agreed_items_td">
                                    <div class="agreed_items_div"></div>
                                </td>

                                <td class="funner_table_td_common agreed_table_td_avatar">
                                    <div class="agreed_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                </td>
                                

                                <td class="funner_table_td_common agreed_table_td"><div class="agreed_table_div_title"><?=$bloggers_neutral->name;?>

                                    <div class="dropdown d-inline-block">
                                        <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <i class="mdi mdi-settings"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                            <a class="dropdown-item" href="/blogger/view/<?=$bloggers_neutral->id;?>">Посмотреть</a>
                                            <a class="dropdown-item" href="/blogger/update/<?=$bloggers_neutral->id;?>">Редактировать</a>
                                            <a class="dropdown-item" href="/blogger/delete/<?=$bloggers_neutral->id;?>">Удалить</a>
                                        </div>
                                    </div>

                                    <span>
                                        <?php
                                            // Выводим img платформы
                                            $pltforms_img_blogger = PlatformForm::find()
                                                ->select('img')
                                                ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                ->Where(['data_platforms.id_blogger' => $bloggers_neutral->id])
                                                ->one();

                                            echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_neutral->id])
                                                ->max('subscribers');

                                            // Выводим данные платформ
                                            $data_platforms = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_neutral->id, 'subscribers' => $subscribers])
                                                ->all();

                                            foreach ($data_platforms as $data_platform)
                                            {
                                                echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                            }
                                        ?>
                                    </span>
                                </td>

                                <!-- Категория -->
                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers_neutral->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin">
                                        <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                    </td>
                                <? } ?>

                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_subscribers_skine">
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_neutral->id])
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
                                <td class="funner_table_td_common funner_table_td_coverage">
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_neutral->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_neutral->id, 'subscribers' => $subscribers])
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
                                <td class="funner_table_td_common funner_table_td_price">
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_neutral->id])
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
                                <td class="funner_table_td_common funner_table_td_format">
                                    <div>
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_neutral->id])
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
                                <td class="funner_table_td_common funner_table_td_cpm">
                                    <div>
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_neutral->id])
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

                                <!-- Переключатель -->
                                <td class="funner_table_td_switcher_skine">
                                    <div class="funner_table_switcher_skine">
                                        <div class='switcher'>
                                            <label class='switcher-label switcher-off' for='off_<?=$bloggers_neutral->id;?>'>off</label>
                                            <input id='off_<?=$bloggers_neutral->id;?>' class='switcher-radio-off' type='radio' name='status_<?=$bloggers_neutral->id;?>' value='2'>
                                                    
                                            <label class='switcher-label switcher-neutral' for='neutral_<?=$bloggers_neutral->id;?>'>neutral</label>
                                            <input id='neutral_<?=$bloggers_neutral->id;?>' class='switcher-radio-neutral' type='radio' name='status_<?=$bloggers_neutral->id;?>' value='0' checked>
                                                    
                                            <label class='switcher-label switcher-on' for='on_<?=$bloggers_neutral->id;?>'>on</label>
                                            <input id='on_<?=$bloggers_neutral->id;?>' class='switcher-radio-on' type='radio' name='status_<?=$bloggers_neutral->id;?>' value='1'>
                                            <div class='switcher-slider'></div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php } // foreach ?>
                    <?php } // bloggers_neutral_db ?>

                    <!-- Выводим всех одобренных блогеров -->
                    <? if ($bloggers_approved_projects_db) { ?>
                        <?php foreach ($bloggers_approved_projects_db as $bloggers_approved) { ?>

                            <tr class="funner_table_body">
                                
                                <td class="agreed_items_td">
                                    <div class="agreed_items_div"></div>
                                </td>

                                <td class="funner_table_td_common agreed_table_td_avatar">
                                    <div class="agreed_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                </td>
                                

                                <td class="funner_table_td_common agreed_table_td"><div class="agreed_table_div_title"><?=$bloggers_approved->name;?>

                                    <div class="dropdown d-inline-block">
                                        <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <i class="mdi mdi-settings"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                            <a class="dropdown-item" href="/blogger/view/<?=$bloggers_approved->id;?>">Посмотреть</a>
                                            <a class="dropdown-item" href="/blogger/update/<?=$bloggers_approved->id;?>">Редактировать</a>
                                            <a class="dropdown-item" href="/blogger/delete/<?=$bloggers_approved->id;?>">Удалить</a>
                                        </div>
                                    </div>

                                    <span>
                                        <?php
                                            // Выводим img платформы
                                            $pltforms_img_blogger = PlatformForm::find()
                                                ->select('img')
                                                ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                ->Where(['data_platforms.id_blogger' => $bloggers_approved->id])
                                                ->one();

                                            echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_approved->id])
                                                ->max('subscribers');

                                            // Выводим данные платформ
                                            $data_platforms = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_approved->id, 'subscribers' => $subscribers])
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
                                        ->Where(['bloggers.id_category' => $bloggers_approved->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin">
                                        <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                    </td>
                                <? } ?>

                                <!-- Подписчики -->
                                <td class="funner_table_td_common funner_table_td_subscribers_skine">
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_approved->id])
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
                                <td class="funner_table_td_common funner_table_td_coverage">
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_approved->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_approved->id, 'subscribers' => $subscribers])
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
                                <td class="funner_table_td_common funner_table_td_price">
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_approved->id])
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
                                <td class="funner_table_td_common funner_table_td_format">
                                    <div>
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_approved->id])
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
                                <td class="funner_table_td_common funner_table_td_cpm">
                                    <div>
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_approved->id])
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

                                <!-- Переключатель -->
                                <td class="funner_table_td_switcher_skine">
                                    <div class="funner_table_switcher_skine">
                                        <div class='switcher'>
                                            <label class='switcher-label switcher-off' for='off_<?=$bloggers_approved->id;?>'>off</label>
                                            <input id='off_<?=$bloggers_approved->id;?>' class='switcher-radio-off' type='radio' name='status_<?=$bloggers_approved->id;?>' value='2'>
                                                    
                                            <label class='switcher-label switcher-neutral' for='neutral_<?=$bloggers_approved->id;?>'>neutral</label>
                                            <input id='neutral_<?=$bloggers_approved->id;?>' class='switcher-radio-neutral' type='radio' name='status_<?=$bloggers_approved->id;?>' value='0'>
                                                    
                                            <label class='switcher-label switcher-on' for='on_<?=$bloggers_approved->id;?>'>on</label>
                                            <input id='on_<?=$bloggers_approved->id;?>' class='switcher-radio-on' type='radio' name='status_<?=$bloggers_approved->id;?>' value='1' checked>
                                            <div class='switcher-slider'></div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php } // foreach ?>
                    <?php } // bloggers_approved_db ?>

                    <? if ($bloggers_rejected_projects_db) { ?>

                        <th class="unner_table_th_rejected" colspan="5">Отклоненные</th>

                        <?php foreach ($bloggers_rejected_projects_db as $bloggers_rejected) { ?>

                            <tr class="funner_table_body">
                                
                                <td class="agreed_items_td">
                                    <div class="agreed_items_div"></div>
                                </td>

                                <td class="funner_table_td_rejected agreed_table_td_avatar">
                                    <div class="agreed_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                </td>
                                

                                <td class="funner_table_td_rejected agreed_table_td"><div class="agreed_table_div_title"><?=$bloggers_rejected->name;?>

                                    <div class="dropdown d-inline-block">
                                        <a class="nav-link dropdown-toggle arrow-none" id="dLabel4" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <i class="mdi mdi-settings"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel4">
                                            <a class="dropdown-item" href="/blogger/view/<?=$bloggers_rejected->id;?>">Посмотреть</a>
                                            <a class="dropdown-item" href="/blogger/update/<?=$bloggers_rejected->id;?>">Редактировать</a>
                                            <a class="dropdown-item" href="/blogger/delete/<?=$bloggers_rejected->id;?>">Удалить</a>
                                        </div>
                                    </div>

                                    <span>
                                        <?php
                                            // Выводим img платформы
                                            $pltforms_img_blogger = PlatformForm::find()
                                                ->select('img')
                                                ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                ->Where(['data_platforms.id_blogger' => $bloggers_rejected->id])
                                                ->one();

                                            echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_rejected->id])
                                                ->max('subscribers');

                                            // Выводим данные платформ
                                            $data_platforms = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_rejected->id, 'subscribers' => $subscribers])
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
                                        ->Where(['bloggers.id_category' => $bloggers_rejected->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_rejected funner_table_td_category_skin">
                                        <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                    </td>
                                <? } ?>

                                <!-- Подписчики -->
                                <td class="funner_table_td_rejected funner_table_td_subscribers_skine">
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_rejected->id])
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
                                <td class="funner_table_td_rejected funner_table_td_coverage">
                                    <div>
                                        <?php
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_rejected->id])
                                                ->max('subscribers');

                                            // Выводим обхват
                                            $coverages_db = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers_rejected->id, 'subscribers' => $subscribers])
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
                                <td class="funner_table_td_rejected funner_table_td_price">
                                    <div>
                                        <span>
                                            <?php
                                                $integration_cost_db = DataPlatformsForm::find()
                                                    ->select('integration_cost')
                                                    ->Where(['id_blogger' => $bloggers_rejected->id])
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
                                <td class="funner_table_td_rejected funner_table_td_format">
                                    <div>
                                        <span>
                                            <?php
                                                $format_db = DataPlatformsForm::find()
                                                    ->select('format')
                                                    ->Where(['id_blogger' => $bloggers_rejected->id])
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
                                <td class="funner_table_td_rejected funner_table_td_cpm">
                                    <div>
                                        <span>
                                            <?php
                                                $cpm_db = DataPlatformsForm::find()
                                                    ->select('cpm')
                                                    ->Where(['id_blogger' => $bloggers_rejected->id])
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

                                <!-- Переключатель -->
                                <td class="funner_table_td_switcher_skine">
                                    <div class="funner_table_td_rejected funner_table_switcher_skine">
                                        <div class='switcher'>
                                            <label class='switcher-label switcher-off' for='off_<?=$bloggers_rejected->id;?>'>off</label>
                                            <input id='off_<?=$bloggers_rejected->id;?>' class='switcher-radio-off' type='radio' name='status_<?=$bloggers_rejected->id;?>' value='2' checked>
                                                    
                                            <label class='switcher-label switcher-neutral' for='neutral_<?=$bloggers_rejected->id;?>'>neutral</label>
                                            <input id='neutral_<?=$bloggers_rejected->id;?>' class='switcher-radio-neutral' type='radio' name='status_<?=$bloggers_rejected->id;?>' value='0'>
                                                    
                                            <label class='switcher-label switcher-on' for='on_<?=$bloggers_rejected->id;?>'>on</label>
                                            <input id='on_<?=$bloggers_rejected->id;?>' class='switcher-radio-on' type='radio' name='status_<?=$bloggers_rejected->id;?>' value='1'>
                                            <div class='switcher-slider'></div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <?php } // foreach ?>
                        <?php } // bloggers_rejected_db ?>

                    <?php } ?>

                <?php } else { ?>
                    
                        Выберите блогера в фильтре

                <?php } ?>
            </tbody>
        </table><!--end /table-->
    <?php ActiveForm::end(); ?>
</div><!--end /tableresponsive-->
