<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
//use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//use yii\helpers;
//use app\models\BloggerForm;
use app\models\node\NodeKlientBlogger;
use app\models\CategoryForm;
use app\models\DataPlatformsForm;
use app\models\PlatformForm;


$this->title = 'Лонг лист';
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
        <li class="menu-funnel-item item-active">
            <a href="/klient/<?=$get_project?>" class="nav-link">Лонг лист</a>
        </li>
        <li class="menu-funnel-item">
            <a href="/klient/agreed<?=$get_project?>" class="nav-link">Согласованные</a>
        </li>
        <li class="menu-funnel-item">
            <a href="/klient/work<?=$get_project?>" class="nav-link">В работе</a>
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

                    <th class="funnel_th_btn">
                        <div class="funnel_th_btn_div funner_table_end_right">
                            <?php 
                            if (Yii::$app->request->get())
                            {
                                if (!Yii::$app->request->get('platform'))
                                {
                                    echo Html::submitButton(Yii::t('app', 'согласовать'), ['class' => 'btn-approve']);
                                }
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
                                    
                                    <td class="long_list_items_td">
                                        <div class="long_list_items_div"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td_avatar">
                                        <div class="long_list_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td"><div class="long_list_table_div_title"><?=$bloggers_neutral->name;?>

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
                                                        echo '<span style="color: #DBD203;">микро</span>';
                                                    }
                                                                
                                                    if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                    {
                                                        echo '<span style="color: #07BF03;">средний</span>';
                                                    }

                                                    if ($subscribers > $coverage_average)
                                                    {
                                                        echo '<span style="color: #ff0000;">крупный</span>';
                                                    }   
                                                ?> 
                                            </span>
                                        </div>
                                    </td>

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
                                    
                                    <td class="long_list_items_td">
                                        <div class="long_list_items_div"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td_avatar">
                                        <div class="long_list_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td"><div class="long_list_table_div_title"><?=$bloggers_approved->name;?>

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
                                    </td>

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
                                                        echo '<span style="color: #DBD203;">микро</span>';
                                                    }
                                                                
                                                    if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                    {
                                                        echo '<span style="color: #07BF03;">средний</span>';
                                                    }

                                                    if ($subscribers > $coverage_average)
                                                    {
                                                        echo '<span style="color: #ff0000;">крупный</span>';
                                                    }   
                                                ?> 
                                            </span>
                                        </div>
                                    </td>

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

                        <!-- Выводим отклонённых блогеров -->
                        <? if ($bloggers_rejected_projects_db) { ?>

                            <th class="unner_table_th_rejected" colspan="5">Отклоненные</th>
                            
                            <?php foreach ($bloggers_rejected_projects_db as $bloggers_rejected) { ?>

                                <tr class="funner_table_body">
                                    
                                    <td class="long_list_items_td">
                                        <div class="long_list_items_div"></div>
                                    </td>

                                    <td class="funner_table_td_rejected long_list_table_td_avatar">
                                        <div class="long_list_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                    </td>

                                    <td class="funner_table_td_rejected long_list_table_td"><div class="long_list_table_div_title"><?=$bloggers_rejected->name;?>

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
                                    </td>

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
                                                        echo '<span style="color: #DBD203;">микро</span>';
                                                    }
                                                                
                                                    if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                    {
                                                        echo '<span style="color: #07BF03;">средний</span>';
                                                    }

                                                    if ($subscribers > $coverage_average)
                                                    {
                                                        echo '<span style="color: #ff0000;">крупный</span>';
                                                    }   
                                                ?> 
                                            </span>
                                        </div>
                                    </td>

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

                    <? if ($bloggers_db) { ?>
                        <?php foreach ($bloggers_db as $bloggers) { ?>

                            <tr class="funner_table_body">
                                    
                                <td class="long_list_items_td">
                                    <div class="long_list_items_div"></div>
                                </td>

                                <td class="funner_table_td_common long_list_table_td_avatar">
                                    <div class="long_list_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                </td>

                                <td class="funner_table_td_common long_list_table_td"><div class="long_list_table_div_title"><?=$bloggers->name;?>

                                    <span>
                                        <?php
                                            // Выводим img платформы
                                            $pltforms_img_blogger = PlatformForm::find()
                                                ->select('img')
                                                ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                ->Where(['data_platforms.id_blogger' => $bloggers->id])
                                                ->one();

                                            echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                            // Выводим макс. кол-во подписчиков
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers->id])
                                                ->max('subscribers');

                                            // Выводим данные платформ
                                            $data_platforms = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers->id, 'subscribers' => $subscribers])
                                                ->all();

                                            foreach ($data_platforms as $data_platform)
                                            {
                                                echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                            }
                                        ?>
                                    </span>
                                </td>

                                <?php
                                    $categories_db = CategoryForm::find()
                                        ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                        ->Where(['bloggers.id_category' => $bloggers->id_category])
                                        ->all();
                                ?>
                                <?php foreach ($categories_db as $categories) { ?>
                                    <td class="funner_table_td_common funner_table_td_category_skin">
                                        <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                    </td>
                                <? } ?>

                                <td class="funner_table_td_common funner_table_td_subscribers_skine">
                                    <div>
                                        <?php
                                            $subscribers = DataPlatformsForm::find()
                                                ->Where(['id_blogger' => $bloggers->id])
                                                ->max('subscribers');
                                        ?>
                                        <span class="funner_table_subscribers_skine"><?=$subscribers ?></span>
                                        <span class="funner_table_subscribers_statys_skine">
                                            <?php 
                                                if ($subscribers < $coverage_micro)
                                                {
                                                    echo '<span style="color: #DBD203;">микро</span>';
                                                }
                                                                
                                                if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                {
                                                    echo '<span style="color: #07BF03;">средний</span>';
                                                }

                                                if ($subscribers > $coverage_average)
                                                {
                                                    echo '<span style="color: #ff0000;">крупный</span>';
                                                }   
                                            ?> 
                                        </span>
                                    </div>
                                </td>

                            </tr>

                        <?php } // foreach ?>
                    <?php } ?>

                <?php } ?>

                <? if(Yii::$app->request->get('platform')) { ?>

                    <?php foreach ($bloggers_neutral_platforms_db as $bloggers_neutral_platforms) { ?>

                        <?php
                        // Выводим макс. кол-во подписчиков
                        $subscribers = DataPlatformsForm::find()
                            ->Where(['id_blogger' => $bloggers_neutral_platforms->id])
                            ->max('subscribers');

                        // Выводим данные платформ
                        $data_platforms = DataPlatformsForm::find()
                            ->Where(['id_blogger' => $bloggers_neutral_platforms->id, 'subscribers' => $subscribers])
                            ->all();

                            //echo Yii::$app->request->get('platform');

                        foreach ($data_platforms as $data_platforms_result)
                        {
                            if ($data_platforms_result->id_platform == Yii::$app->request->get('platform')) { ?>

                                <tr class="funner_table_body">
                                    
                                    <td class="long_list_items_td">
                                        <div class="long_list_items_div"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td_avatar">
                                        <div class="long_list_table_avatar_div"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></div>
                                    </td>

                                    <td class="funner_table_td_common long_list_table_td"><div class="long_list_table_div_title"><?=$bloggers_neutral_platforms->name;?>

                                        <span>
                                            <?php
                                                // Выводим img платформы
                                                $pltforms_img_blogger = PlatformForm::find()
                                                    ->select('img')
                                                    ->leftJoin('data_platforms', '`data_platforms`.`id_platform` = `platforms`.`id`')
                                                    ->Where(['data_platforms.id_blogger' => $bloggers_neutral_platforms->id])
                                                    ->one();

                                                echo '<img src='.$pltforms_img_blogger->img.' alt="">';
                           
                                                // Выводим макс. кол-во подписчиков
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_neutral_platforms->id])
                                                    ->max('subscribers');

                                                // Выводим данные платформ
                                                $data_platforms = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_neutral_platforms->id, 'subscribers' => $subscribers])
                                                    ->all();

                                                foreach ($data_platforms as $data_platform)
                                                {
                                                    echo '<a href="'.$data_platform->account_link.'"target="_blank">'.$data_platform->account.'</a>';
                                                }
                                            ?>
                                        </span>
                                    </td>

                                    <?php
                                        $categories_db = CategoryForm::find()
                                            ->leftJoin('bloggers', '`bloggers`.`id_category` = `categories`.`id`')
                                            ->Where(['bloggers.id_category' => $bloggers_neutral_platforms->id_category])
                                            ->all();
                                    ?>
                                    <?php foreach ($categories_db as $categories) { ?>
                                        <td class="funner_table_td_common funner_table_td_category_skin">
                                            <div class="funner_table_category_skin"><?=$categories->title ?></div>
                                        </td>
                                    <? } ?>

                                    <td class="funner_table_td_common funner_table_td_subscribers_skine">
                                        <div>
                                            <?php
                                                $subscribers = DataPlatformsForm::find()
                                                    ->Where(['id_blogger' => $bloggers_neutral_platforms->id])
                                                    ->max('subscribers');
                                            ?>
                                            <span class="funner_table_subscribers_skine"><?=$subscribers ?></span>
                                            <span class="funner_table_subscribers_statys_skine">
                                                <?php 
                                                    if ($subscribers < $coverage_micro)
                                                    {
                                                        echo '<span style="color: #DBD203;">микро</span>';
                                                    }
                                                                
                                                    if ($subscribers > $coverage_micro && $subscribers < $coverage_average)
                                                    {
                                                        echo '<span style="color: #07BF03;">средний</span>';
                                                    }

                                                    if ($subscribers > $coverage_average)
                                                    {
                                                        echo '<span style="color: #ff0000;">крупный</span>';
                                                    }   
                                                ?> 
                                            </span>
                                        </div>
                                    </td>

                                    <!-- <td class="funner_table_td_switcher_skine">
                                        <div class="funner_table_switcher_skine">
                                            <div class='switcher'>
                                                <label class='switcher-label switcher-off' for='off_<?=$bloggers_neutral_platforms->id;?>'>off</label>
                                                <input id='off_<?=$bloggers_neutral_platforms->id;?>' class='switcher-radio-off' type='radio' name='status_<?=$bloggers_neutral_platforms->id;?>' value='2'>
                                                    
                                                <label class='switcher-label switcher-neutral' for='neutral_<?=$bloggers_neutral_platforms->id;?>'>neutral</label>
                                                <input id='neutral_<?=$bloggers_neutral_platforms->id;?>' class='switcher-radio-neutral' type='radio' name='status_<?=$bloggers_neutral_platforms->id;?>' value='0' checked>
                                                    
                                                <label class='switcher-label switcher-on' for='on_<?=$bloggers_neutral_platforms->id;?>'>on</label>
                                                <input id='on_<?=$bloggers_neutral_platforms->id;?>' class='switcher-radio-on' type='radio' name='status_<?=$bloggers_neutral_platforms->id;?>' value='1'>
                                                <div class='switcher-slider'></div>
                                            </div>
                                        </div>
                                    </td> -->

                                </tr>
                            <?php } // foreach ?>

                        <?php } ?>

                    <?php } // foreach data platfoms ?>
                
                <? } // platform ?>
            </tbody>
        </table><!--end /table-->
    <?php ActiveForm::end(); ?>
</div><!--end /tableresponsive-->


<!-- <pre> -->
<?php //var_dump($bloggers); ?>
<!-- </pre> -->

<?php

// foreach ($bloggers as $value) {
//     echo $value->title;
// }


?>