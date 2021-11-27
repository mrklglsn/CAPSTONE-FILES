const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.copy('node_modules/datatables.net-dt/css/jquery.dataTables.min.css', 'public/css/');

mix.copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/js/');

mix.copy('node_modules/video.js/dist/video-js.min.css', 'public/css/');

mix.copy('node_modules/video.js/dist/video.min.js', 'public/js/');

mix.copy('node_modules/sweetalert2/dist/sweetalert2.min.js', 'public/js/');

mix.copy('node_modules/sweetalert2/dist/sweetalert2.min.css', 'public/css/');

mix.copy('node_modules/toastify-js/src/toastify.js', 'public/js/');

mix.copy('node_modules/toastify-js/src/toastify.css', 'public/css/');