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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/';
    public $css = [
        //'css/site.css',
        'css/bootstrap.min.css',
        'css/style.css',
        'css/icons.css',
        'plugins/timepicker/tempusdominus-bootstrap-4.css',
        'plugins/select2/select2.min.css', // Multiple Select
        'plugins/custombox/custombox.min.css', // Modal Window
        'plugins/fancybox/jquery.fancybox.min.css', // Для видео в кретивах
    ];
    public $js = [
        // jQuery
        'js/jquery.min.js',
        // 'js/jquery.core.js',
        'js/bootstrap.bundle.min.js', // для левого виджета Проекты // header профиль
        //'js/waves.min.js',
        //'js/jquery.slimscroll.min.js',

        // 'plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
        // 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',

        'plugins/moment/moment.js', // Multiple Select
        'plugins/timepicker/bootstrap-material-datetimepicker.js', // Multiple Select
        'plugins/clockpicker/jquery-clockpicker.min.js', // Multiple Select
        'plugins/colorpicker/jquery-asColorPicker.min.js', // Multiple Select
        'plugins/select2/select2.min.js', // Multiple Select
        'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js', // Multiple Select
        'plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', // Multiple Select
        'plugins/bootstrap-maxlength/bootstrap-maxlength.min.js', // Multiple Select
        'plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js', // Multiple Select
        'pages/jquery.forms-advanced.js', // Multiple Select

        'js/jquery.min.js', // Modal Window
        'js/bootstrap.bundle.min.js', // Modal Window
        'plugins/custombox/custombox.min.js', // Modal Window
        'plugins/custombox/custombox.legacy.min.js', // Modal Window
        'pages/jquery.modal-animation.js', // Modal Window

        // 'plugins/apexcharts/apexcharts.min.js',
        // 'https://apexcharts.com/samples/assets/irregular-data-series.js',
        // 'https://apexcharts.com/samples/assets/series1000.js',
        // 'https://apexcharts.com/samples/assets/ohlc.js',
        // 'pages/jquery.dashboard.init.js',

        // App js
        // 'js/app.js',

        // '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'

        // Кнопка "Показать ещё" - временная
        'js/show_more.js',

        // Для видео в креативах
        'plugins/fancybox/jquery.fancybox.min.js',

        // Пункты активных меню
        'js/menu_item_active.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
