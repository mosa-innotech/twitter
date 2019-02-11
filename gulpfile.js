var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('scss', function() {
    gulp.src('resources/scss/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('public/css/'))
});

gulp.task('watch', function(){
	gulp.watch('resources/scss/*.scss', ['scss']);
});

gulp.task('default', ['watch']);
