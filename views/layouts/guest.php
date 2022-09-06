<?php

/** @var yii\web\View $this */
/** @var string $content */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\assets\GuestAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

GuestAsset::register($this);
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

        <?= $content ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>