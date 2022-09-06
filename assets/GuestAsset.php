<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GuestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/guest/';
    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
        'vendor/animate/animate.css',
        'vendor/css-hamburgers/hamburgers.min.css',
        'vendor/animsition/css/animsition.min.css',
        'vendor/select2/select2.min.css',
        'vendor/daterangepicker/daterangepicker.css',
        'css/util.css',
        'css/main.css',

        'plugins/fancybox/jquery.fancybox.min.css', // Для видео в кретивах
    ];
    public $js = [
        'vendor/jquery/jquery-3.2.1.min.js',
        'vendor/animsition/js/animsition.min.js',
        'vendor/bootstrap/js/popper.js',
        'vendor/bootstrap/js/bootstrap.min.js',
        'vendor/select2/select2.min.js',
        'vendor/daterangepicker/moment.min.js',
        'vendor/daterangepicker/daterangepicker.js',
        'vendor/countdowntime/countdowntime.js',
        'js/main.js',

        // Для видео в креативах
        'plugins/fancybox/jquery.fancybox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
