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

                    <div class="card border mb-0 shadow-none">
                        <div class="card-header p-0" id="heading_<?=$users_klient->id ?>">
                            <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_<?=$users_klient->id ?>" aria-expanded="true" aria-controls="collapse_<?=$users_klient->id ?>"> 
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
                                            
                        <div id="collapse_<?=$users_klient->id ?>" class="collapse " aria-labelledby="heading_<?=$users_klient->id ?>" data-parent="#accordionExample">
                            <div class="card-body">

                                <?php 
                                    //foreach ($users_klient_db as $users_klient)
                                    //{
                                        $project_db = ProjectForm::find()
                                            ->leftJoin('node_project_klient', '`node_project_klient`.`id_project` = `projects`.`id`')
                                            ->where(['node_project_klient.id_klient' => $users_klient->id])
                                            ->all();
                                        
                                        // echo '<pre>';
                                        // 	var_dump($project_db);
                                        // echo '<pre>';

                                        echo '<ul>';

																$all_projects = array(); 
																foreach ($project_db as $project)
                                                    {
                                                        $platforms_db = PlatformForm::find()
                                                            ->leftJoin('node_project_platform', '`node_project_platform`.`id_platform` = `platforms`.`id`')
                                                            ->where(['node_project_platform.id_project' => $project->id])
                                                            ->all();
                                                        foreach ($platforms_db as $platforms) {
                                                        	if(!isset($all_projects[$platforms->id])) {
                                                        		$all_projects[$platforms->id] = array(
																					'platform' => $platforms,
																					'rows' => array(),		                                                        	
                                                        		);
                                                        	}
                                                        	$all_projects[$platforms->id]['rows'][] = $project;	
                                                        }	    
																	} 
																                                                                                                          
                                                foreach ($all_projects as $platt)
                                                    {
                                                        ?>
 														<li class="widget_li"> <img src="https://files.constantcontact.com/65cf42e1301/0654f56b-8387-4734-be7d-e8bcc52a97d2.png" alt="Нет изображения" class="thumb-small rounded-circle">
                                                                    <?=$platt['platform']->title ?>                                                       
                                                        <?php
	
                                                            foreach ($platt['rows'] as $proj) { ?>

                                                                    <ol>
                                                                        <a href="?project=<?=$proj->id ?>"> <?=$proj->title?></a>
                                                                    </ol>

                                                                
                                                            <? } ?>
                                           </li>                 
                                                    <? }
                                            
                                        echo '</ul>';
                                    //}
                                ?>
                                <!-- Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. -->
                            </div>
                        </div>
                    </div> <!-- end card -->

                <? } ?>
