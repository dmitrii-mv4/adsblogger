<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
//use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

use app\widgets\ProjectsManager;
use app\widgets\FinanceWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> - ADSBlogger.media</title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

        <!-- Top Bar Start -->
        <div class="topbar">
             <!-- Navbar -->
             <nav class="navbar-custom">

                <a href="/manager"><img src="/web/images/logo.png" alt="logo" class="logo"></a>

                <!-- MENU -->
                <?php
                    if (Yii::$app->user->identity->role == 'admin')
                    {
                        echo Nav::widget([
                            'options' => ['class' => 'js_menu_admin menu-admin'],
                            'items' => [
                                ['label' => 'Пользователи', 'url' => ['/user/']],
                                ['label' => 'Блогеры', 'url' => ['/blogger/']],
                                ['label' => 'Платформы', 'url' => ['/platform/']],
                                ['label' => 'Проекты', 'url' => ['/project/']],
                                ['label' => 'Категории', 'url' => ['/category/']],
                            ],
                        ]);
                    } else {
                        echo Nav::widget([
                            'options' => ['class' => 'js_menu_admin menu-admin'],
                            'items' => [
                                ['label' => 'Пользователи', 'url' => ['/user/']],
                                ['label' => 'Блогеры', 'url' => ['/blogger/']],
                                ['label' => 'Проекты', 'url' => ['/project/']],
                            ],
                        ]);
                    }

                    

                   //echo Yii::$app->controller->id;
                ?>

<!-- если перестанет работать avtive на меню <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script> -->
    
                <ul class="list-unstyled topbar-nav float-right mb-0 flex">

                    <!-- Поиск -->
                    <li class="dropdown hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="поиск по сервису" class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>

                    <li class="dropdown dropdown-log">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            
                            <?php if (Yii::$app->user->identity->avatar) { ?>
                                <img src="<?=Yii::$app->user->identity->avatar ?>" alt="Нет изображения" class="thumb-xl rounded-circle">
                            <?php } else { ?>
                                <img src="https://cg02414.tmweb.ru/web/images/users/user-1.jpg" alt="Нет изображения" class="rounded-circle">
                            <? } ?>

                            <?= Yii::$app->user->identity->name?>
                        </a>
                    </li>

                    <!-- Уведомления -->
                    <li class="dropdown notification-main">

                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline nav-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge active"> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Уведомления (3)
                            </h6>
                            <div class="slimscroll notification-list">

                                <!-- Список уведомлений -->
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a> -->
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a> -->
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                    <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                                </a> -->
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a> -->
                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a> -->
                            </div>
                            <!-- All-->
                            <!-- <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a> -->
                        </div>
                    </li>
                    <li class="dropdown"><?= Html::a("<i class=\"dripicons-exit text-muted mr-2\"></i>", ['/logout'], ['data' => ['method' => 'post'],'class' => 'nav-link dropdown-toggle arrow-none waves-light waves-effect',]);?> </li> 
                </ul>
            </nav>
            <!-- end navbar-->
        </div> <!-- end topbar -->
        
        <div class="page-wrapper">
            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    
                    <!-- widget_left -->
                    <div class="main__widget_left">
                        <?php echo ProjectsManager::widget(); ?>

                        <?php echo FinanceWidget::widget(); ?>
                    </div>
                    <!-- end widget_left -->

                    <!-- table body -->
                    <div class="card card_one">
                        <div class="main-content card-body">

                            <?= $content ?>
                            
                        </div> <!-- end card-body -->
                    </div>

                    <!-- <div class="widget_right">
                        
                    </div> -->
                
                </div><!-- end container-fluid -->

            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>