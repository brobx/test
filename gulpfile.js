var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

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

elixir(function (mix) {

    // Common tasks.
    mix.copy('bower_components/font-awesome/fonts', 'public/fonts');
    mix.copy('bower_components/Ionicons/fonts', 'public/fonts');
    mix.copy('bower_components/bootstrap/fonts', 'public/fonts');

    // Backend.
    backend(mix);
    
    // frontend
    frontend(mix);
});

function frontend(mix) {

    mix.styles([
        './bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        './bower_components/bootstrap-star-rating/css/star-rating.min.css'
        ], 'public/assets/css/frontend.css')

        .browserify('main.js', 'resources/assets/js/build/bundle.js')

        .scripts([
            './bower_components/moment/min/moment.min.js',
            './bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            './bower_components/bootstrap-star-rating/js/star-rating.min.js',
            'build/bundle.js'
        ], 'public/assets/js/frontend.js');
}


function backend(mix) {
    mix.styles([
            './bower_components/bootstrap/dist/css/bootstrap.min.css',
            './bower_components/font-awesome/css/font-awesome.min.css',
            './bower_components/Ionicons/css/ionicons.min.css',
            './bower_components/AdminLTE/plugins/bootstrap-slider/slider.css',
            './bower_components/AdminLTE/dist/css/AdminLTE.min.css',
            './bower_components/AdminLTE/dist/css/skins/skin-blue.min.css',
            './bower_components/dropzone/dist/min/basic.min.css',
            './bower_components/dropzone/dist/min/dropzone.min.css',
            './bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
            './bower_components/bootstrap-star-rating/css/star-rating.min.css',
            'admin/styles.css'
        ], 'public/assets/css/backend.css')

        .browserify('admin/main.js', 'resources/assets/js/admin/build/bundle.js')

        .scripts([
            './bower_components/jquery/dist/jquery.min.js',
            './bower_components/bootstrap/dist/js/bootstrap.min.js',
            './bower_components/moment/min/moment.min.js',
            './bower_components/AdminLTE/dist/js/app.min.js',
            './bower_components/dropzone/dist/min/dropzone.min.js',
            './bower_components/seiyria-bootstrap-slider/dependencies/js/modernizr.js',
            './bower_components/AdminLTE/plugins/bootstrap-slider/bootstrap-slider.js',
            './bower_components/tinymce/tinymce.min.js',
            './bower_components/tinymce/jquery.tinymce.min.js',
            './bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            './bower_components/bootstrap-star-rating/js/star-rating.min.js',
            'admin/build/bundle.js'

        ], 'public/assets/js/backend.js');
}
