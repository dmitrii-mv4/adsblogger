<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>

<style type="text/css">
    .topbar { display: none; }
    .widget_left{ display: none; }
    .card_one { text-align: center; }
    .card_one .card-body { background: #f2f2f2; }
    .site-error {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
</style>

<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <a href="/">На главную</a>
    </p>

</div>
