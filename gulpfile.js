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
    // en
    mix.styles([
            'bootstrap.min.css',
            'flexslider.css',
            'animate.css',
            'seq-slider/sequencejs-theme.apple-style.css',
            'fontiran.css',
            'style.css',
            'more.css',
        ], 'public/css/en.css', 'resources/assets/css')

        .webpack([
            'jquery-1.8.3.min.js',
            'jquery.easing.min.js',
            'jquery.flexslider.js',
            'jquery.parallax-1.1.3.js',
            'bootstrap.min.js',
            'hover-dropdown.js',
            'link-hover.js',
            'common-scripts.js',
            'scrolling-nav.js',
            'bxslider.js',
            'wow.min.js',
            'seq-slider/jquery.sequence-min.js',
            'seq-slider/sequencejs-options.apple-style.js',
        ], 'public/js/en.js', 'resources/assets/js');

    //fa
    mix.styles([
            'bootstrap.min.css',
            'flexslider.css',
            'animate.css',
            'seq-slider/sequencejs-theme.apple-style.css',
            'fontiran.css',
            'style.css',
            'more.css',
            'rtl.css',
        ], 'public/css/fa.css', 'resources/assets/css')

        .webpack([
            'jquery-1.8.3.min.js',
            'jquery.easing.min.js',
            'jquery.flexslider.js',
            'jquery.parallax-1.1.3.js',
            'bootstrap.min.js',
            'hover-dropdown.js',
            'link-hover.js',
            'common-scripts.js',
            'scrolling-nav.js',
            'bxslider.js',
            'wow.min.js',
            'seq-slider/jquery.sequence-min.js',
            'seq-slider/sequencejs-options.apple-style.js',
        ], 'public/js/fa.js', 'resources/assets/js');



    // Admin
    mix.sass('rtl.scss', 'public/css/admin/rtl.css')
        .styles([
            'bootstrap/css/bootstrap.css',
            'dist/css/AdminLTE.css',
            'dist/css/skins/skin-blue.css',
        ], 'public/css/admin/admin.css', 'resources/assets/bower/AdminLTE')
        .styles('plugins/iCheck/square/blue.css',
            'public/css/admin/iCheckBlue.css', 'resources/assets/bower/AdminLTE')
        .webpack('admin.js', 'public/js/admin/admin.js')
        .webpack('plugins/iCheck/icheck.min.js',
            'public/js/admin/iCheck.js', 'resources/assets/bower/AdminLTE')
        .webpack('plugins/flot/jquery.flot.min.js',
            'public/js/admin/flot.js', 'resources/assets/bower/AdminLTE')
        .webpack(['plugins/input-mask/jquery.inputmask.js',
                'plugins/input-mask/jquery.inputmask.extensions.js',
                'plugins/input-mask/jquery.inputmask.regex.extensions.js'
            ],
            'public/js/admin/jquery.inputmask.js', 'resources/assets/bower/AdminLTE')
        .styles('plugins/select2/select2.min.css',
            'public/css/admin/select2.css', 'resources/assets/bower/AdminLTE')
        .webpack('plugins/select2/select2.full.min.js',
            'public/js/admin/select2.js', 'resources/assets/bower/AdminLTE')
        .copy('resources/assets/bower/AdminLTE/dist/img', 'public/img')
        .copy('resources/assets/bower/AdminLTE/bootstrap/fonts', 'public/build/css/fonts')
        .copy('resources/assets/bower/AdminLTE/plugins/iCheck/square/b*.png', 'public/css/admin')
        .version(['css/admin/admin.css',
            'css/admin/rtl.css',
            'js/admin/admin.js',
            'js/admin/iCheck.js',
            'js/admin/jquery.inputmask.js',
            'public/js/admin/flot.js'
        ]);
});
