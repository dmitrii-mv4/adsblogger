<?php
use app\models\ProjectForm;
use yii\web\Linkable;
use yii\widgets\LinkPager;
use app\models\node\NodeProjectKlient;
use yii\widgets\ActiveForm;
?>

<? if (Yii::$app->request->get('project')) { ?>
<div class="widget_left">
    <div class="widget_right_header">
        <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-toggle="tab" href="#projects" role="tab">Финансы</a>
                </li>
            </ul>
    </div> <!-- end widget_right_header -->

    <!-- Tab panes -->
    <div class="tab-content widget_right_body">
        <div class="tab-pane active p-3" id="projects" role="tabpanel"> 

            <div class="accordion" id="accordionExample">

                <div class="widget_finance">

                    <div class="widget_finance__header">Бюджет на проект: 
                        <span>
                            <?
                                foreach ($projects_db as $project)
                                {    
                                    echo $project['budget'];
                                }
                            ?> ₽
                        </span>
                    </div>

                    <div class="widget_finance__content">
                        <div class="widget_finance__items">
                            <div class="widget_finance__item_title">Остаток бюджета:</div>
                            <div class="widget_finance__item" style="background: linear-gradient(186.94deg, #FF6A5F -0.35%, #FFA773 92.68%);">
                                <div class="widget_finance__money">
                                    <?
                                        foreach ($projects_db as $project)
                                        {    
                                            echo $project['balance'];
                                        }
                                    ?>
                                ₽</div>
                                <div class="widget_finance__interest" style="display: none;">100%</div>
                            </div>
                        </div>

                        <div class="widget_finance__items">
                            <div class="widget_finance__item_title">В резерве:</div>
                            <div class="widget_finance__item" style="background: linear-gradient(186.92deg, #4255A9 0%, #3AC58F 100%);">
                                <div class="widget_finance__money">
                                    <?
                                        foreach ($projects_db as $project)
                                        {    
                                            echo $project['reserve'];
                                        }
                                    ?>
                                ₽</div>
                                <div class="widget_finance__interest" style="display: none;">0%</div>
                            </div>
                        </div>

                        <div class="widget_finance__items">
                            <div class="widget_finance__item_title">Израсходовано:</div>
                            <div class="widget_finance__item" style="background: linear-gradient(186.92deg, #B431D7 0%, #F944A9 100%);">
                                <div class="widget_finance__money">
                                    <?
                                        foreach ($projects_db as $project)
                                        {    
                                            echo $project['used'];
                                        }
                                    ?>
                                ₽</div>
                                <div class="widget_finance__interest" style="display: none;">0%</div>
                            </div>
                        </div>
                    </div>
                </div>

                
                  
            </div>           
        </div>
    </div> <!-- end widget_right_body -->
</div>
 
<? } ?>