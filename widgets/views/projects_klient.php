<?php
use app\models\ProjectForm;
use yii\web\Linkable;
use yii\widgets\LinkPager;
use app\models\node\NodeProjectKlient;
use yii\widgets\ActiveForm;
/**
 * Данные которые доступны для вывода
 * $platforms->id
 * $platforms->title
 * $platforms->link
 * $platforms->image_link
 * 
 * $project->->id
 * $project->->title
 * $project->->budget
 * 
 * $number_records кол-во платфом на странице
 * 
 **/
?>

<div class="widget_left">
    <div class="widget_left_header">
        <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-toggle="tab" href="#projects" role="tab">Проекты</a>
                </li>
            </ul>
    </div> <!-- end widget_left_header -->

    <!-- Tab panes -->
    <div class="tab-content widget_left_body">
        <div class="tab-pane active p-3" id="projects" role="tabpanel"> 

            <div class="accordion" id="accordionExample">

                <?php foreach ($platforms_db as $platforms) { ?>

                    <div class="review-box align-item-center">
                        <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$platforms->id ?>" aria-expanded="true" aria-controls="collapse_<?=$platforms->id ?>">
                            <h4 class="header-title text-center">
                                <img style="margin-top: -5px;" src="<?=$platforms->img; ?>" alt="platform" class="thumb-xl rounded-circle">
                                <a href="?platform=<?=$platforms->id; ?>"><?=$platforms->title; ?></a>
                            </h4>
                        </button> 
                    </div>

                    <div id="collapse_<?=$platforms->id ?>" class="collapse " aria-labelledby="heading_<?= $platforms->id ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
                                
                                // Выводим все проекты к которому клиенту принадлежат
                                $projects_klient_db = NodeProjectKlient::find()->where(['id_klient' => Yii::$app->user->identity->id])->all();

                                    foreach ($projects_klient_db as $projects_klient)
                                    {
                                        // Выводим проекты которые привязаны к каждой платформе
                                        $projects_db = ProjectForm::find()
                                            ->leftJoin('node_project_platform', '`node_project_platform`.`id_project` = `projects`.`id`')
                                            ->where([
                                                'node_project_platform.id_project'  => $projects_klient->id_project,
                                                'node_project_platform.id_platform' => $platforms->id
                                            ])->all();

                            ?>
                                        <? foreach ($projects_db as $project) { ?>
                                
                                            <p class="text-muted mb-0 p-platform"><a href="?project=<?=$project->id; ?>"><?=$project->title ?></a></p>
                                        <? } ?>
                                    <? } ?>
                        </div>
                    </div>
                <?php } ?>
           
                  <!-- <button id="more">:vb</button>    --> 
                 </div>           
        </div>
    </div> <!-- end widget_left_body -->
</div> <!-- end widget_left -->  

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <script>
       function funcSuccess(data){
            $(".accordion").text (data);
        }

        $(document).ready (function(){
            
            $("#button").bind("click", function(){
                let pass = "2"
                $.ajax({
                    url: '',
                    type: "POST",
                    data: ({
                    
                        pass: pass,
                        }),
                        dataType: "html",
                        beforeSend: function(){
                            $("#info").text("jldbldfybr dsflkl");
                        }
                        // funcBefore
                        ,
                        success: funcSuccess
                    

                });
                });

            
        });
    </script> -->
    
<!-- // $(document).ready(function(){
 
// var inProgress = false; // идет процесс загрузки
// var startFrom = 2; // позиция с которой начинается вывод данных
 
    // $('#more').click(function() {
    //     if (!inProgress) {
    //         $.ajax({
    //             url: 'ProjectsJson.php', // путь к ajax-обработчику
    //             method: 'POST',
    //             data: {
    //                 "start" : startFrom
    //             },
    //             beforeSend: function() {
    //                 inProgress = true;
    //             }
    //         }).done(function(data){
    //             data = jQuery.parseJSON(data); // данные в json
    //             if (data.length > 0){
    //                 // добавляем записи в блок в виде html
    //                 $.each(data, function(index, data){
    //                     $("#articles").append("<p><b>" + data.title + "</b><br />" + data.text + "</p>");
    //                 });
    //                 inProgress = false;
    //                 startFrom += 2;
    //             }
    //         });
    //     }
//     });
// }); -->
<!-- <script type="text/javascript">
function funcSuccess(data){
            // $(".widget_left_body").text (data);
            data = jQuery.parseJSON(data); // данные в json
                if (data.length > 0){
                    // добавляем записи в блок в виде html
                    $.each(data, function(data){
                        $(".widget_left_body").append("<p><b>" + data + "</b><br />" + data+ "</p>");
        }
    )}
                };

        $(document).ready (function(){
            
            $("#more").bind("click", function(){
                let pass = 3;
                $.ajax({
                    url: 'widgets/views/ProjectsJson.php',
                    type: "POST",
                    data: ({
                        pass: pass,
                       }),
                        dataType: "html",
                        beforeSend: function(){
                            $("#info").text("jldbldfybr dsflkl");
                        }
                        // funcBefore
                        ,
                        success: funcSuccess
                    

                });
                });

            
        });
</script> -->
 
<!-- 
                    <div class="card border mb-0 shadow-none">
                        <div class="card-header p-0" id="heading_<?=$users_klient->id ?>">
                            <h5 class="my-1">
                                <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$users_klient->id ?>" aria-expanded="true" aria-controls="collapse_<?=$users_klient->id ?>">
                                    <img src="/web/images/Ellipse_3.png" alt="user" class="thumb-xl rounded-circle">
                                    <b><?=$users_klient->name ?></b>
                                    <?=$users_klient->name_company ?>
                                </button>
                            </h5>
                        </div> -->
                         <!--                    
                        <div id="collapse_<?=$users_klient->id ?>" class="collapse " aria-labelledby="heading_<?=$users_klient->id ?>" data-parent="#accordionExample">
                            <div class="card-body"> -->

                               <!--  -->