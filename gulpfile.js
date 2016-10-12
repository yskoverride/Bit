var gulp = require('gulp');
var phpunit = require('gulp-phpunit');
var notify  = require('gulp-notify');
var gutil = require('gulp-util');

gulp.task('phpunit', function() {
  var options = {debug: false, notify: true};
  gulp.src('phpunit.xml')
    .pipe(phpunit('./vendor/bin/phpunit',options))
    .on('error',gutil.log);
});

gulp.task('watch', function () {
    gulp.watch('**/*.php', ['phpunit']);
});

gulp.task('default', ['watch']);
