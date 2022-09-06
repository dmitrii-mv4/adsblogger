<?php
use app\models\ProjectForm;
use app\models\PlatformForm;
use app\models\User;
use app\models\node\NodeProjectKlient;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<!-- widget_left -->
<div class="widget_left">
    <div class="widget_left_header">
        <!-- Nav tabs -->
        <ul class="nav nav-pills nav-justified" role="tablist">
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link active" data-toggle="tab" href="#clients" role="tab">Клиенты</a>
            </li>

            <li class="nav-item waves-effect waves-light">
                <a class="nav-link" data-toggle="tab" href="#in-work" role="tab">В работе</a>
            </li>
                                
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link" data-toggle="tab" href="#no-projects" role="tab">Без проектов</a>
            </li>
        </ul>
    </div> <!-- end widget_left_header -->

    <!-- Tab panes -->
    <div class="tab-content widget_left_body">
        
        <!-- Все клиенты -->
        <div class="tab-pane active p-3" id="clients" role="tabpanel">
            
            <!-- Все клиенты -->
            <div class="accordion" id="accordionExample">

                <? foreach ($users_klient_db as $users_klient) { ?>

                    <div class="card border mb-0 shadow-none">
                        <div class="card-header p-0" id="heading_<?=$users_klient->id ?>">
                            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_user_all_<?=$users_klient->id ?>" aria-expanded="true" aria-controls="collapse_user_all_<?=$users_klient->id ?>"> 
                                <h5 class="my-1">

                                    <?php if ($users_klient->avatar) { ?>
                                        <img src="<?=$users_klient->avatar ?>" alt="Нет изображения" class="thumb-xl rounded-circle">
                                    <?php } else { ?>
                                        <img src="/web/images/users/user-1.jpg" alt="Нет изображения" class="thumb-xl rounded-circle">
                                    <? } ?>
                                    
                                    <b><?=$users_klient->name ?></b>
                                    <div class="group"><?=$users_klient->name_company ?></div>

                                    <?php
                                        // Всего проектов у клиента
                                        $project_in_work = NodeProjectKlient::find()
                                            ->where(['id_klient' => $users_klient->id])
                                            ->count();
                                    ?>
                                    <p class="group">проектов в работе: <?=$project_in_work ?></p>
                               </h5> 
                            </button>
                        </div>
                                            
                        <div id="collapse_user_all_<?=$users_klient->id ?>" class="collapse" aria-labelledby="heading_<?=$users_klient->id ?>" data-parent="#accordionExample">
                            <div class="card-body">

                                <?php 
                                    $project_db = ProjectForm::find()
                                        ->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `projects`.`id`')
                                        ->where(['node_project_klient.id_klient' => $users_klient->id])
                                        ->all();

                                    echo '<ul>';
                                                
                                        $all_projects = array(); 
                                        foreach ($project_db as $project)
                                        {
                                            $platforms_db = PlatformForm::find()
                                                ->leftJoin('node_project_platform', '`node_project_platform`.`id_platform` = `platforms`.`id`')
                                                ->where(['node_project_platform.id_project' => $project->id])
                                                ->all();

                                            foreach ($platforms_db as $platforms)
                                            {
                                                if(!isset($all_projects[$platforms->id])) 
                                                {
                                                    $all_projects[$platforms->id] = array(
                                                        'platform' => $platforms,
                                                        'rows' => array(),
                                                    );
                                                }
                                                $all_projects[$platforms->id]['rows'][] = $project; 
                                            }       
                                        } 
                                                                                                                                                                          
                                        foreach ($all_projects as $platt) { ?>
                                                
                                            <li class="widget_li">
                                                <img src="<?=$platt['platform']->img ?>" alt="Нет изображения" class="thumb-small rounded-circle">
                                                <?=$platt['platform']->title ?>                                                       
                                                <?php
        
                                                    foreach ($platt['rows'] as $proj) { ?>

                                                        <ol>
                                                            <a href="/manager/?project=<?=$proj->id ?>"> <?=$proj->title?></a>
                                                        </ol>

                                                <? } ?>
                                            </li>                 
                                        <? }
                                            
                                    echo '</ul>';
                                ?>
                            </div>
                        </div>
                    </div> <!-- end card -->

                <? } ?>

            </div> <!-- end accordion -->

<?php
    $per_page = 1;
    $ddata = (int)$users_klient_count_db;
    $entry = 'klients_all';
    $count_1 = (int)($ddata/$per_page) + 1;

    if($ddata > $per_page) {
?>            
    <div class="showMore text-center" data-entry="<?php echo($entry); ?>" data-page="1" data-count="<?php echo($count_1); ?>" data-per="<?php echo($per_page); ?>">
    <span class="funner_table_category_skin btn">Показать ещё</span>
    </div>
<?php } ?>

    <script>
            var loadingFlag = false;
          window.addEventListener('DOMContentLoaded', function(){  
            $('.showMore').click(function()
            {
                var but = $(this);
                var contra = $(this).prev();
                var entry = $(this).attr('data-entry');
                var page = parseInt($(this).attr('data-page'));
                var count = parseInt($(this).attr('data-count'));
                var per_page = parseInt($(this).attr('data-per'));
                if (!loadingFlag)
                {
                    console.log('oli');
                    loadingFlag = true;
                    $.ajax({
                        type: 'get',
                        url: '/manager/ja',
                        data: {
                            'entry': entry,
                            'page': page + 1,
//                            'page': page,
                            'per_page': per_page,
                        },
                        success: function(data)
                        {
                            console.log(data);
                            page++;
                             but.attr('data-page', page);
                            loadingFlag = false;
                            contra.append(data);
                            if (page >= count) {
                                but.hide();
                            }    
                        }
                    });
                }
                return false;
            });
            });
    </script>
            
        </div>

        <!-- Клиенты в работе у менеджера -->
        <div class="tab-pane p-3" id="in-work" role="tabpanel">
             <div class="accordion" id="accordionExample">

             <? foreach ($klients_in_work_db as $klients_in_work) { ?>

                <div class="card border mb-0 shadow-none box_users_klient_in_work">
                    <div class="card-header p-0" id="heading_<?=$klients_in_work->id ?>">
                        <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$klients_in_work->id ?>" aria-expanded="true" aria-controls="collapse_<?=$klients_in_work->id ?>"> 
                            <h5 class="my-1">

                                <?php if ($klients_in_work->avatar) { ?>
                                    <img src="<?=$klients_in_work->avatar ?>" alt="avatar" class="thumb-xl rounded-circle">
                                <?php } else { ?>
                                    <img src="https://cg02414.tmweb.ru/web/images/users/user-1.jpg" alt="Нет изображения" class="thumb-xl rounded-circle">
                                <? } ?>
                                
                                <b><?=$klients_in_work->name ?></b>
                                <div class="group"><?=$klients_in_work->name_company ?></div>
                                <?php
                                    // Всего проектов у клиента
                                    $project_in_work = NodeProjectKlient::find()
                                        ->where(['id_klient' => $klients_in_work->id])
                                        ->count();
                                ?>
                                <p class="group">проектов в работе: <?=$project_in_work ?></p>
                            </h5> 
                        </button>
                    </div>
                                        
                    <div id="collapse_<?=$klients_in_work->id ?>" class="collapse " aria-labelledby="heading_<?=$klients_in_work->id ?>" data-parent="#accordionExample">
                        <div class="card-body">

                            <?php 
                                $project_db = ProjectForm::find()
                                    ->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `projects`.`id`')
                                    ->where(['node_project_klient.id_klient' => $klients_in_work->id])
                                    ->all();

                                echo '<ul>';
                                            
                                    $all_projects = array(); 
                                    foreach ($project_db as $project)
                                    {
                                        $platforms_db = PlatformForm::find()
                                            ->leftJoin('node_project_platform', '`node_project_platform`.`id_platform` = `platforms`.`id`')
                                            ->where(['node_project_platform.id_project' => $project->id])
                                            ->all();
                                                
                                        foreach ($platforms_db as $platforms) 
                                        {
                                            if(!isset($all_projects[$platforms->id])) 
                                            {
                                                $all_projects[$platforms->id] = array(
                                                    'platform' => $platforms,
                                                    'rows' => array(),                                                                  
                                                );
                                            }
                                            $all_projects[$platforms->id]['rows'][] = $project; 
                                        }       
                                    } 
                                                                                                                                                                          
                                    foreach ($all_projects as $platt) { ?>

                                        <li class="widget_li"> <img src="<?=$platt['platform']->img ?>" alt="Нет изображения" class="thumb-small rounded-circle">
                                            <?=$platt['platform']->title ?>
                                            <? foreach ($platt['rows'] as $proj) { ?>

                                                <ol>
                                                    <a href="?project=<?=$proj->id ?>"> <?=$proj->title?></a>
                                                </ol>
 
                                            <? } ?>
                                        </li>                 
                                    <? }
                                        
                                echo '</ul>';
                            ?>
                        </div>
                    </div>
                </div> <!-- end card -->

                <? } ?>    
  
            </div> <!-- end accordion -->
<?php
    $per_page = 1;
    $ddata = (int)$users_klient_count_db;
    $entry = 'klients_in_work';
    $count_1 = (int)($ddata/$per_page) + 1;

    if($ddata > $per_page) {
?>            
    <div class="showMore text-center" data-entry="<?php echo($entry); ?>" data-page="1" data-count="<?php echo($count_1); ?>" data-per="<?php echo($per_page); ?>">
    <span class="funner_table_category_skin btn">Показать ещё</span>
    </div>
<?php } ?>

    <script>
            var loadingFlag = false;
          window.addEventListener('DOMContentLoaded', function(){  
            $('.showMore').click(function()
            {
                var but = $(this);
                var contra = $(this).prev();
                var entry = $(this).attr('data-entry');
                var page = parseInt($(this).attr('data-page'));
                var count = parseInt($(this).attr('data-count'));
                var per_page = parseInt($(this).attr('data-per'));
                if (!loadingFlag)
                {
                    console.log('oli');
                    loadingFlag = true;
                    $.ajax({
                        type: 'get',
                        url: '/manager/ja',
                        data: {
                            'entry': entry,
                            'page': page + 1,
//                            'page': page,
                            'per_page': per_page,
                        },
                        success: function(data)
                        {
                            console.log(data);
                            page++;
                             but.attr('data-page', page);                           
                            loadingFlag = false;                            
                            contra.append(data);
                            if (page >= count) {
                                but.hide();
                            }    
                        }
                    });
                }
                return false;
            });
            });
    </script>

        </div>

        <!-- Клиенты без проетов -->
        <div class="tab-pane p-3" id="no-projects" role="tabpanel">

            <div class="accordion" id="">

                <? foreach ($klient_no_project_db as $klient_no_project) { ?>

                    <div class="card border mb-0 shadow-none box_users_klient_no_projects">
                        <div class="card-header p-0" id="">
                            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$users_klient->id ?>" aria-expanded="true" aria-controls="collapse_<?=$users_klient->id ?>"> 
                                <h5 class="my-1">
                                    
                                    <?php if ($klient_no_project->avatar) { ?>
                                        <img src="<?=$klient_no_project->avatar ?>" alt="Нет изображения" class="thumb-xl rounded-circle">
                                    <?php } else { ?>
                                        <img src="/web/images/users/user-1.jpg" alt="Нет изображения" class="thumb-xl rounded-circle">
                                    <? } ?>

                                    <b><?=$klient_no_project->name ?></b>
                                    <p class="group"><?=$klient_no_project->name_company ?> </p>
                                                                  
                                </h5> 
                            </button>

                        </div>

                    </div> <!-- end card -->

                <? } ?>                
  
            </div> <!-- end accordion -->

<?php
    $per_page = 1;
    $ddata = (int)$klient_no_project_count_db;
    $entry = 'klients_no_project';
    $count_1 = (int)($ddata/$per_page) + 1;

    if($ddata > $per_page) {
?>            
    <div class="showMore text-center" data-entry="<?php echo($entry); ?>" data-page="1" data-count="<?php echo($count_1); ?>" data-per="<?php echo($per_page); ?>">
    <span class="funner_table_category_skin btn">Показать ещё</span>
    </div>
<?php } ?>

    <script>
            var loadingFlag = false;
          window.addEventListener('DOMContentLoaded', function(){  
            $('.showMore').click(function()
            {
                var but = $(this);
                var contra = $(this).prev();
                var entry = $(this).attr('data-entry');
                var page = parseInt($(this).attr('data-page'));
                var count = parseInt($(this).attr('data-count'));
                var per_page = parseInt($(this).attr('data-per'));
                if (!loadingFlag)
                {
                    console.log('oli');
                    loadingFlag = true;
                    $.ajax({
                        type: 'get',
                        url: '/manager/ja',
                        data: {
                            'entry': entry,
                            'page': page + 1,
//                            'page': page,
                            'per_page': per_page,
                        },
                        success: function(data)
                        {
                            console.log(data);
                            page++;
                             but.attr('data-page', page);                           
                            loadingFlag = false;                            
                            contra.append(data);
                            if (page >= count) {
                                but.hide();
                            }    
                        }
                    });
                }
                return false;
            });
            });
    </script>
        
        </div>
    </div> <!-- end widget_left_body -->
    
</div> <!-- end widget_left -->