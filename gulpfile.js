var gulp = require('gulp'),
babel = require('gulp-babel'),
gulpif = require('gulp-if'),
gutil = require('gulp-util'),
concat = require('gulp-concat'),
uglify = require('gulp-uglify'),
nano = require("gulp-cssnano"),
browserify = require('browserify'),
babelify = require('babelify'),
vueify = require('vueify'),
source = require('vinyl-source-stream'),
sourcemaps = require('gulp-sourcemaps'),
notify = require('gulp-notify'),
prefix = require('gulp-autoprefixer'),
sass = require('gulp-dart-sass'),
browserSync = require('browser-sync');
buffer = require('vinyl-buffer');

let theProxy = 'https://hektor.mx/ginger/';


/**
 * Wait for pug and sass tasks, then launch the browser-sync Server
 */
gulp.task('browser-sync', function () {
  browserSync.init({
    proxy: theProxy,
    // server: {
    //     baseDir: "./"
    // }
  });
  
});

// gulp.task('js', function () {
//     return gulp.src([
//      './assets/js/app.js'
//     ])
//         .pipe(babel())
//         .pipe(gulpif(gutil.env.env == 'prod',uglify()))
//         .pipe(concat('app-main.js'))
//         .pipe(gulp.dest('assets/js'));
// });

gulp.task('js:vue', function () {
	return browserify('src/js/index.js')
	.transform(babelify, { presets: ['es2015'], plugins: ["transform-runtime"] })
	.transform(vueify)
	.bundle().on("error", function(err){ gutil.log(err); this.emit('end'); })
	.pipe(source("app.js"))
  .pipe(buffer())
  .pipe(gulpif(gutil.env.env == 'prod', uglify()))
  .pipe(gulp.dest("./assets/js/"))
  .pipe(notify({ message: 'Finished Compile Vue App' }));
});


gulp.task('jsmin', function () {
    return gulp.src([
        './assets/js/app.js'
    ]) 
    .pipe(sourcemaps.init())
    .pipe(concat('app.min.js')) //the name of the resulting file
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('assets/js/')) //the destination folder
    .pipe(notify({ message: 'Finished minifying app JavaScript' }))
    .pipe(browserSync.reload({stream: true}));
  });






  gulp.task('sass', function () {
    return gulp.src('src/sass/*.scss')
      .pipe(sass({
        includePaths: ['src/sass/'],
        outputStyle: 'compressed'
      }))
      .pipe(sourcemaps.init())
      .on('error', sass.logError)
      .pipe(prefix(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {
        cascade: true
      }))
      .pipe(sourcemaps.write('./'))
      .pipe(gulp.dest('assets/css/'))
      .pipe(notify({ message: 'Finished minifying Styles' }))
      .pipe(browserSync.reload({stream: true}));
  });





gulp.task('css', function () {
    var dest = './web/compiled/css';
    return gulp.src([
       
    ])
        .pipe(concat('styles.css'))
        .pipe(gulpif(gutil.env.env == 'prod', nano()))
        .pipe(gulp.dest(dest));
});

setTimeout(function(){ 
  gulp.task('php', browserSync.reload); 
}, 3000);

 

gulp.task('watch', function () {
    gulp.watch('src/sass/**/*.scss', ['sass']);
    gulp.watch('src/js/**/*.vue', ['js:vue']);
    gulp.watch('src/js/*.js', ['js:vue']);
    gulp.watch('assets/js/*.js', ['jsmin']);
    gulp.watch('./**/*.php', ['php']);
  });

  gulp.task('default', ['browser-sync', 'watch']);
  //gulp.task('default', ['sass', 'js:vue', 'jsmin']);
