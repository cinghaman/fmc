/* File: gulpfile.js */
'use strict';

var gulp   = require('gulp'),
    sass =   require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    csscomb = require('gulp-csscomb'),
    uncss  = require('gulp-uncss'),
    cleanCSS = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    bless = require('gulp-bless'),
    gcmq = require('gulp-group-css-media-queries'),
    plumber = require('gulp-plumber'),
    jshint = require('gulp-jshint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    size =require('gulp-size'),
    uglify = require('gulp-uglify');

/* config */

var base_src  = 'src';
var base_dest = 'assets';

var AUTOPREFIXER_BROWSERS = [
  '> 1%',
  'ie >= 8',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4',
  'bb >= 10'
];

var onError =function(err) {
  console.log(err.toString());
  this.emit('end');
};

/* styles */

gulp.task('styles',function() {
  return gulp.src('src/sass/**/*.scss')
    .pipe(plumber({
       errorHandler: onError
    }))
    .pipe(sass({
      style:'expanded'
    }))
    .pipe(gcmq())
    .pipe(autoprefixer({
      browsers: AUTOPREFIXER_BROWSERS,
      cascade:false
    }))
    .pipe(csscomb())
    .pipe(gulp.dest('assets/css'))
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(gulp.dest('assets/css'));
});

/* scripts */

gulp.task('scripts',function() {
  return gulp.src('src/js/**/*.js')
    .pipe(plumber({
      errorHandler: onError
    }))
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('bundle.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(rename('bundle.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('scriptsVendor',function() {
  return gulp.src('src/vendor/**/*.js')
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('assets/js'))
    .pipe(rename('vendor.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('default',[],function() {
  gulp.start('watch','styles','scripts','scriptsVendor');
});

gulp.task('watch', function() {
  gulp.watch('src/js/**/*.js',['scripts']);
  gulp.watch('src/sass/**/*.scss',['styles']);
  gulp.watch('src/vendor/**/*.js',['scriptsVendor']);
});