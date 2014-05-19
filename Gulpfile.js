/**
 * Variables
 */
var gulp = require('gulp'), less = require('gulp-less'), plumber = require('gulp-plumber'), livereload = require('gulp-livereload'), watch = require('gulp-watch');

/**
 * Tasks
 */
gulp.task('default', ['styles', 'copy']);

gulp.task('watch', ['default'], function() {

    gulp.src('assets/less/**/**.less')
    .pipe(watch(function(files) {
        runStyles().pipe(livereload());
    }));

});

/**
 * Copy
 */
gulp.task('copy', function() {
    gulp.src('bower_components/codemirror/lib/**')
        .pipe(gulp.dest('public/assets/codemirror'));

    gulp.src('bower_components/codemirror/mode/markdown/markdown.js')
        .pipe(gulp.dest('public/assets/codemirror'));
});

gulp.task('styles', function() { return runStyles(); });

function runStyles()
{
    return gulp.src('assets/less/main.less')
                .pipe(plumber())
                .pipe(less())
                .pipe(gulp.dest('public/assets'));
}