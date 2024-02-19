const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

/*
 |--------------------------------------------------------------------------
 | Backend Mix's
 |--------------------------------------------------------------------------
 |
 | Backend Mixes
 |
 */
mix.js('resources/backend/js/app.js', 'public/backend/js');
mix.styles(['resources/backend/js/app.js'], 'public/backend/css/app.css').version();

mix.styles([
    'public/backend/css/social-icons.css',
    'public/backend/css/owl.carousel.css',
    'public/backend/css/owl.theme.css',
    'public/backend/css/prism.css',
    'public/backend/css/main.css',
    'public/backend/css/custom.css',
], 'public/backend/css/all.css').version();

mix.js(
    'public/backend/js/scripts.js', 'public/backend/js/scripts.min.js')
    .js('resources/backend/assets/js/profile.js', 'public/backend/assets/js/profile.js')
    .js('resources/backend/assets/js/custom/custom.js', 'public/backend/assets/js/custom/custom.js')
    .js('resources/backend/assets/js/custom/custom-datatable.js', 'public/backend/assets/js/custom/custom-datatable.js')
    .version();

mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css',
    'public/backend/assets/css/bootstrap.min.css');

mix.copy('node_modules/datatables.net-dt/css/jquery.dataTables.min.css',
    'public/backend/assets/css/jquery.dataTables.min.css');
mix.copy('node_modules/datatables.net-dt/images', 'public/backend/assets/images');
mix.copy('node_modules/select2/dist/css/select2.min.css',
    'public/backend/assets/css/select2.min.css');
mix.copy('node_modules/sweetalert/dist/sweetalert.css',
    'public/backend/assets/css/sweetalert.css');
mix.copy('node_modules/izitoast/dist/css/iziToast.min.css',
    'public/backend/assets/css/iziToast.min.css');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/css',
    'public/backend/assets/css/@fortawesome/fontawesome-free/css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts',
    'public/backend/assets/css/@fortawesome/fontawesome-free/webfonts');

mix.babel('node_modules/jquery.nicescroll/dist/jquery.nicescroll.js',
    'public/backend/assets/js/jquery.nicescroll.js');
mix.babel('node_modules/jquery/dist/jquery.min.js',
    'public/backend/assets/js/jquery.min.js');
mix.babel('node_modules/popper.js/dist/umd/popper.min.js',
    'public/backend/assets/js/popper.min.js');
mix.babel('node_modules/bootstrap/dist/js/bootstrap.min.js',
    'public/backend/assets/js/bootstrap.min.js');
mix.babel('node_modules/datatables.net/js/jquery.dataTables.min.js',
    'public/backend/assets/js/jquery.dataTables.min.js');
mix.babel('node_modules/select2/dist/js/select2.min.js',
    'public/backend/assets/js/select2.min.js');
mix.babel('node_modules/sweetalert/dist/sweetalert.min.js',
    'public/backend/assets/js/sweetalert.min.js');
mix.babel('node_modules/izitoast/dist/js/iziToast.min.js',
    'public/backend/assets/js/iziToast.min.js');
