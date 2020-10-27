var gulp  = require('gulp');
var sass  = require('gulp-sass');
var csso = require('gulp-csso');
var sourcemaps  = require('gulp-sourcemaps');
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var bourbon = require('node-bourbon').includePaths;
var neat = require('node-neat').includePaths;

var build = './wp-content/themes/wrcgroup-marketing/';


gulp.task('sass', function () {
  gulp.src('./wp-content/themes/wrcgroup-marketing/sass/style.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass()
    .on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(build));
});

// UPDATE THIS after reviewing JS that's being included in site from old site
gulp.task('concat', function() {
});

gulp.task('default', ['sass', 'concat'], function () {
  gulp.watch('./wp-content/themes/wrcgroup-marketing/sass/**/*.scss', ['sass']);
//  gulp.watch('./src/wp-content/themes/wrcgroup-marketing/js/**/*.js', ['concat']);
});
