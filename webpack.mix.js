let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'resources/assets/sass/blog-post.css',
        'resources/assets/sass/bootstrap.css',
        'resources/assets/sass/font-awesome.css',
        'resources/assets/sass/metisMenu.css',
        'resources/assets/sass/sb-admin-2.css',
        'resources/assets/sass/styles.css'
    ], 'public/css/libs.css')
    .styles([
        'resources/assets/sass/blueimp-gallery.css',
        'resources/assets/sass/blueimp-gallery-indicator.css'
    ], 'public/css/blueimp.css')
    .scripts([
        'resources/assets/js/jquery.js',
        'resources/assets/js/bootstrap.js',
        'resources/assets/js/metisMenu.js',
        'resources/assets/js/sb-admin-2.js',
        'resources/assets/js/scripts.js'
    ], 'public/js/libs.js')
    .scripts([
        'resources/assets/js/blueimp-helper.js',
        'resources/assets/js/blueimp-gallery.js',
        'resources/assets/js/blueimp-gallery-fullscreen.js',
        'resources/assets/js/blueimp-gallery-indicator.js',
        'resources/assets/js/jquery.blueimp-gallery.js'
    ], 'public/js/blueimp.js');
