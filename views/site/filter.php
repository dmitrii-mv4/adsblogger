<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
use app\models\BloggerForm;

$this->title = 'Фильтер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
    <?php $form = ActiveForm::begin(); ?>
        <table class="table mb-0 table-centered long_list_table">
            <thead>
                <tr>
                    <th>№ п/п</th>
                    <th></th>
                    <th>Аккаун в инстаграм</th>
                    <th class="item_center">Категория</th>
                    <th class="item_center">Подписчики</th>
                    <!-- <th class="item_center"> -->
                        <? //Html::submitButton(Yii::t('app', 'сохранить'), ['class' => 'btn-approve']) ?>
                    <!-- </th> -->
                </tr>
            </thead>
            <tbody> 
            <?php     
                    // Если есть get запрос, то выводим блогеров по фильтру
                    if (Yii::$app->request->get())
                    {
                        // Выводим блогеров привязанные только к платформе
                        if (Yii::$app->request->get('platrorm'))
                        {
                            foreach ($blogger_data_platforms_db as $blogger_data_platforms)
                            {
                            ?>
                                <tr class="long_list_table_body">
                                    <td><?=$blogger_data_platforms->id;?></td>
                                    <td class="long_list_table_body__icon"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></td>
                                    <td class="long_list_table_body__title"><?=$blogger_data_platforms->name;?>
                                        <span>
                                            <img src="/web/images/Ellipse_16.png" alt="">
                                            <?=$blogger_data_platforms->account; ?>
                                        </span>
                                    </td>
                                    <td class="long_list_table_body__category item_center">Fitness</td>
                                    <td class="long_list_table_body__subscribers item_center"><? //$blogger_data_platforms->subscribers;?>
                                        <span>средний</span>
                                    </td>
                                    <!-- <td class="item_center">
                                        <div class='switcher'>
                                            <label class='switcher-label switcher-off' for='off_<?//$blogger_data_platforms->id;?>'>off</label>
                                            <input id='off_<?//$blogger_data_platforms->id;?>' class='switcher-radio-off' type='radio' name='<?//$blogger_data_platforms->id;?>' value='2' <? //if($blogger_data_platforms['long_list_status_klient'] == 2) {echo "checked";} ?>>
                                                                
                                            <label class='switcher-label switcher-neutral' for='neutral_<?//$blogger_data_platforms->id;?>'>neutral</label>
                                            <input id='neutral_<?//$blogger_data_platforms->id;?>' class='switcher-radio-neutral' type='radio' name='<?//$blogger_data_platforms->id;?>' value='0' checked <? //if($blogger_data_platforms['long_list_status_klient'] == 0) {echo "checked";} ?>>
                                                                
                                            <label class='switcher-label switcher-on' for='on_<?//$blogger_data_platforms->id;?>'>on</label>
                                            <input id='on_<?//$blogger_data_platforms->id;?>' class='switcher-radio-on' type='radio' name='<?//$blogger_data_platforms->id;?>' value='1' <? //if($blogger_data_platforms['long_list_status_klient'] == 1) {echo "checked";} ?>>
                                            <div class='switcher-slider'></div>
                                        </div>
                                    </td> -->
                                </tr>
                            <?
                            }
                        } elseif (Yii::$app->request->get('project'))
                        {
                            foreach ($node_project_blogger_db as $node_project_blogger)
                            {
                            ?>
                                <tr class="long_list_table_body">
                                    <td><?=$node_project_blogger->id;?></td>
                                    <td class="long_list_table_body__icon"><img src="/web/images/Ellipse_3.png" alt="" class="rounded-circle mr-1"></td>
                                    <td class="long_list_table_body__title"><?=$node_project_blogger->name;?>
                                        <span>
                                            <img src="/web/images/Ellipse_16.png" alt="">
                                            <?=$node_project_blogger->account; ?>
                                        </span>
                                    </td>
                                    <td class="long_list_table_body__category item_center">Fitness</td>
                                    <td class="long_list_table_body__subscribers item_center"><? //$node_project_blogger->subscribers;?>
                                        <span>средний</span>
                                    </td>
                                    <!-- <td class="item_center">
                                        <div class='switcher'>
                                            <label class='switcher-label switcher-off' for='off_<?//$node_project_blogger->id;?>'>off</label>
                                            <input id='off_<?//$node_project_blogger->id;?>' class='switcher-radio-off' type='radio' name='<?//$node_project_blogger->id;?>' value='2' <? //if($node_project_blogger['long_list_status_klient'] == 2) {echo "checked";} ?>>
                                                                    
                                            <label class='switcher-label switcher-neutral' for='neutral_<?//$node_project_blogger->id;?>'>neutral</label>
                                            <input id='neutral_<?//$node_project_blogger->id;?>' class='switcher-radio-neutral' type='radio' name='<?//$node_project_blogger->id;?>' value='0' <? //if($node_project_blogger['long_list_status_klient'] == 0) {echo "checked";} ?>>
                                                                    
                                            <label class='switcher-label switcher-on' for='on_<?//$node_project_blogger->id;?>'>on</label>
                                            <input id='on_<?//$node_project_blogger->id;?>' class='switcher-radio-on' type='radio' name='<?//$node_project_blogger->id;?>' value='1' <? //if($node_project_blogger['long_list_status_klient'] == 1) {echo "checked";} ?>>
                                            <div class='switcher-slider'></div>
                                        </div>
                                    </td> -->
                                </tr>
                            <?
                            }
                        }
                    }
                    ?>
            </tbody>
        </table><!--end /table-->
    <?php ActiveForm::end(); ?>
</div><!--end /tableresponsive-->
