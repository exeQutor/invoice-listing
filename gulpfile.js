var gulp          = require('gulp');
var $             = require('gulp-load-plugins')();

var sassPaths = [
  'node_modules/foundation-sites/scss',
  'node_modules/motion-ui/src'
];

function sass() {
  return gulp.src(['assets/scss/*.scss', "!assets/scss/_*.scss"])
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compressed' // if css compressed **file size**
    })
    .on('error', $.sass.logError))
    .pipe(gulp.dest('assets/css'));
}

function js() {
  return gulp.src(['assets/js/*.js', "!assets/js/*.min.js"])
		.pipe($.uglify())
		.pipe($.rename({
			suffix: ".min"
		}))
		.pipe(gulp.dest('assets/js'));
}

function serve() {
  gulp.watch(['assets/scss/**/*.scss'], sass);
  gulp.watch(['assets/js/*.js', "!assets/js/*.min.js"], js);
}

gulp.task('sass', sass);
gulp.task('js', js);
gulp.task('serve', gulp.series(['sass', 'js'], serve));
gulp.task('default', gulp.series(['sass', 'js'], serve));
