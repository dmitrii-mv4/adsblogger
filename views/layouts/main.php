<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
// use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

use app\widgets\ProjectsWidget;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> - ADSBlogger.media</title>
		
		    <!-- Font Google -->
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500&family=Poppins:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	</noscript>
    <link rel="shortcut icon" href="/web/main/img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/web/main/img/favicon.ico" type="image/x-icon" />
	<!-- For phone mask -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>		
	
        <?php $this->head() ?>
    </head>

    <body class="v-dark dsn-effect-scroll dsn-cursor-effect dsn-ajax ">
    <?php $this->beginBody() ?>

       <?= $content ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>