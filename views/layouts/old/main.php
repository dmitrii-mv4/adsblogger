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
        <?php $this->head() ?>
    </head>

    <body class="v-dark dsn-effect-scroll dsn-cursor-effect dsn-ajax ">
    <?php $this->beginBody() ?>

       <?= $content ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>