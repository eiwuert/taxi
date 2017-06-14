const { mix } = require('laravel-mix');

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

    // cleave
    mix.js('node_modules/cleave.js/dist/cleave.min.js', 'public/js/admin/cleave.js')
       .version();

    // en
    mix.styles([
            'resources/assets/css/bootstrap.min.css',
            'resources/assets/css/flexslider.css',
            'resources/assets/css/animate.css',
            'resources/assets/css/seq-slider/sequencejs-theme.apple-style.css',
            'resources/assets/css/fontiran.css',
            'resources/assets/css/style.css',
            'resources/assets/css/more.css',
        ], 'public/css/en.css')
        .js([
            'resources/assets/js/jquery-1.8.3.min.js',
            'resources/assets/js/jquery.easing.min.js',
            'resources/assets/js/jquery.flexslider.js',
            'resources/assets/js/jquery.parallax-1.1.3.js',
            'resources/assets/js/bootstrap.min.js',
            'resources/assets/js/hover-dropdown.js',
            'resources/assets/js/link-hover.js',
            'resources/assets/js/common-scripts.js',
            'resources/assets/js/scrolling-nav.js',
            'resources/assets/js/bxslider.js',
            'resources/assets/js/wow.min.js',
            'resources/assets/js/seq-slider/jquery.sequence-min.js',
            'resources/assets/js/seq-slider/sequencejs-options.apple-style.js',
        ], 'public/js/en.js')
        .version();

    //fa
    mix.styles([
            'resources/assets/css/bootstrap.min.css',
            'resources/assets/css/flexslider.css',
            'resources/assets/css/animate.css',
            'resources/assets/css/seq-slider/sequencejs-theme.apple-style.css',
            'resources/assets/css/fontiran.css',
            'resources/assets/css/style.css',
            'resources/assets/css/more.css',
            'resources/assets/css/rtl.css',
        ], 'public/css/fa.css')
        .js([
            'resources/assets/js/jquery-1.8.3.min.js',
            'resources/assets/js/jquery.easing.min.js',
            'resources/assets/js/jquery.flexslider.js',
            'resources/assets/js/jquery.parallax-1.1.3.js',
            'resources/assets/js/bootstrap.min.js',
            'resources/assets/js/hover-dropdown.js',
            'resources/assets/js/link-hover.js',
            'resources/assets/js/common-scripts.js',
            'resources/assets/js/scrolling-nav.js',
            'resources/assets/js/bxslider.js',
            'resources/assets/js/wow.min.js',
            'resources/assets/js/seq-slider/jquery.sequence-min.js',
            'resources/assets/js/seq-slider/sequencejs-options.apple-style.js',
        ], 'public/js/fa.js')
        .version();



    // Admin
    mix.sass('resources/assets/sass/admin.sass', 'public/css/admin/admin-fix.css'),
    mix.sass('resources/assets/sass/rtl.scss', 'public/css/admin/rtl.css')
        .styles([
            'resources/assets/bower/AdminLTE/bootstrap/css/bootstrap.css',
            'resources/assets/bower/AdminLTE/dist/css/AdminLTE.css',
            'resources/assets/bower/AdminLTE/dist/css/skins/skin-blue.css',
        ], 'public/css/admin/admin.css')
        .styles('resources/assets/bower/AdminLTE/plugins/iCheck/square/blue.css',
            'public/css/admin/iCheckBlue.css')
        .js('resources/assets/js/admin.js', 'public/js/admin/admin.js')
        .js('resources/assets/bower/AdminLTE/plugins/iCheck/icheck.min.js',
            'public/js/admin/iCheck.js')
        .js('resources/assets/bower/AdminLTE/plugins/flot/jquery.flot.min.js',
            'public/js/admin/flot.js')
        .js('node_modules/chart.js/dist/Chart.bundle.js', 'public/js/admin/chart.js')
        .js(['resources/assets/bower/AdminLTE/plugins/input-mask/jquery.inputmask.js',
            'resources/assets/bower/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js',
            'resources/assets/bower/AdminLTE/plugins/input-mask/jquery.inputmask.regex.extensions.js'
            ], 'public/js/admin/jquery.inputmask.js')
        .styles('resources/assets/bower/AdminLTE/plugins/select2/select2.min.css',
            'public/css/admin/select2.css')
        .js('resources/assets/bower/AdminLTE/plugins/select2/select2.full.min.js',
            'public/js/admin/select2.js')
        .copy('resources/assets/bower/AdminLTE/dist/img', 'public/img')
        .copy('resources/assets/bower/AdminLTE/bootstrap/fonts', 'public/build/css/fonts')
        .copy('resources/assets/bower/AdminLTE/plugins/iCheck/square/b*.png', 'public/css/admin')
        .version();
  
if (mix.config.inProduction) {
    mix.version();
}
