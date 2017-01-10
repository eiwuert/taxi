const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss', 'bootstrap.css')
       .webpack('app.js');

    // Admin
    mix.styles([
        'bootstrap/css/bootstrap.css',
        'dist/css/AdminLTE.css',
        'dist/css/skins/skin-blue.css',
        ], 'public/css/admin/admin.css', 'resources/assets/bower/AdminLTE')
        //.version('css/admin/admin.css')
        .styles('plugins/iCheck/square/blue.css', 
                'public/css/admin/iCheckBlue.css', 'resources/assets/bower/AdminLTE')
        //.version('css/admin/iCheckBlue.css')
        .webpack('admin.js', 'public/js/admin/admin.js')
        //.version('js/admin/admin.js')
        .webpack('plugins/iCheck/icheck.min.js', 
                 'public/js/admin/iCheck.js', 'resources/assets/bower/AdminLTE')
        //.version('js/admin/iCheck.js')
        .webpack(['plugins/input-mask/jquery.inputmask.js',
                  'plugins/input-mask/jquery.inputmask.extensions.js',
                  'plugins/input-mask/jquery.inputmask.regex.extensions.js'],
                'public/js/admin/jquery.inputmask.js', 'resources/assets/bower/AdminLTE')
        .copy('resources/assets/bower/AdminLTE/dist/img', 'public/img')
        .copy('resources/assets/bower/AdminLTE/bootstrap/fonts', 'public/css/fonts')
        .copy('resources/assets/bower/AdminLTE/plugins/iCheck/square/b*.png', 'public/css/admin');
});
