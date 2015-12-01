var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');
    
var config = {
    assets_path: './resources/assets',
    build_path: './public/build'
};

config.bower_path = config.assets_path + '/../bower_components';

config.build_path_js = config.build_path + '/js';
config.build_vendor_path_js = config.build_path_js + '/vendor';
config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap-tpls.min.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.min.js',
    config.bower_path + '/angular-cookies/angular-cookies.min.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.min.js',
];

config.build_path_css = config.build_path + '/css';
config.build_vendor_path_css = config.build_path_css + '/vendor';
config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css'
];

config.build_path_html = config.build_path + '/views';
config.build_path_font = config.build_path + '/fonts';
config.build_path_image = config.build_path + '/images';

gulp.task('copy-font', function() {
    gulp.src([
       config.assets_path + '/fonts/**/*'
    ])
        .pipe(gulp.dest(config.build_path_font))
        .pipe(liveReload());
});

gulp.task('copy-image', function() {
    gulp.src([
       config.assets_path + '/images/**/*'
    ])
        .pipe(gulp.dest(config.build_path_image))
        .pipe(liveReload());
});

gulp.task('copy-html', function() {
    gulp.src([
       config.assets_path + '/js/views/**/*.html'
    ])
        .pipe(gulp.dest(config.build_path_html))
        .pipe(liveReload());
});

gulp.task('copy-styles', function() {
    gulp.src([
       config.assets_path + '/css/**/*.css'
    ])
        .pipe(gulp.dest(config.build_path_css))
        .pipe(liveReload());
    
    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_vendor_path_css))
        .pipe(liveReload());
});

gulp.task('copy-scripts', function() {
    gulp.src([
       config.assets_path + '/js/**/*.js'
    ])
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());
    
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_vendor_path_js))
        .pipe(liveReload());
});

gulp.task('clear-build-folder', function() {
    clean.sync(config.build_path);
});

gulp.task('default', ['clear-build-folder'], function() {
    gulp.start('copy-html', 'copy-font', 'copy-image');
    
    elixir(function(mix) {
         mix.styles(
             config.vendor_path_css.concat([config.assets_path + '/css/**/*.css']),
             'public/css/all.css',
             config.assets_path
         );

         mix.scripts(
             config.vendor_path_js.concat([config.assets_path + '/js/**/*.js']),
             'public/js/all.js',
             config.assets_path
         );

         mix.version(['js/all.js', 'css/all.css']);
    });
});

gulp.task('watch-dev', ['clear-build-folder'], function() {
    liveReload.listen();
    gulp.start('copy-styles', 'copy-scripts', 'copy-html', 'copy-font', 'copy-image');
    gulp.watch(config.assets_path + '/**', [
        'copy-styles', 'copy-scripts', 'copy-html'
    ]);
});
