<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
        'img/favicon.png',
        'img/apple-touch-icon.png',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy',
        // Remove Bootstrap CSS files
        // 'vendor/bootstrap/css/bootstrap.min.css',
        // 'vendor/bootstrap-icons/bootstrap-icons.css',
        'vendor/boxicons/css/boxicons.min.css',
        'vendor/glightbox/css/glightbox.min.css',
        'vendor/swiper/swiper-bundle.min.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js',
        'js/main.js',
        'https://cdn.startbootstrap.com/sb-forms-latest.js',
        'vendor/purecounter/purecounter_vanilla.js',
        // Remove Bootstrap JS files
        // 'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/glightbox/js/glightbox.min.js',
        'vendor/isotope-layout/isotope.pkgd.min.js',
        'vendor/swiper/swiper-bundle.min.js',
        'vendor/waypoints/noframework.waypoints.js',
        'vendor/php-email-form/validate.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // Remove BootstrapAsset
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
