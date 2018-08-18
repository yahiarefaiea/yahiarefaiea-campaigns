//  LOAD PACKAGES
var gulp = require('gulp'),
    del = require('del'),
    runSequence = require('run-sequence'),
    browserSync = require('browser-sync'),
    pkg = require('./package.json'),
    banner = require('gulp-banner'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    uglifycss = require('gulp-uglifycss'),
    rename = require('gulp-rename'),
    pug = require('gulp-pug'),
    babel = require('gulp-babel'),
    stylus = require('gulp-stylus'),
    koutoSwiss = require('kouto-swiss'),
    fs = require('fs'),

    //  DIRECTORIES
    root = 'application',
    dest = 'release',
    assets = 'includes',
    file = 'nuo',
    min = 'lite',
    js = 'javascripts',
    img = 'images',
    php = 'php',

    //  BANNER COMMENT
    comment =
      '/*\n'+
      ' *  <%= pkg.name %> <%= pkg.version %>\n'+
      ' *  Last update on: <%= new Date().getUTCFullYear() %>/'+
      '<%= new Date().getUTCMonth()+1 %>/<%= new Date().getUTCDate() %>\n'+
      ' */\n\n',

    //  BABEL SRC
    babelSrc = [
      root+'/babel/lib/jquery-2.2.4.js',
      root+'/babel/app.js'
    ];

//  DELETE
gulp.task('del', function() {
  return del.sync(dest);
});

//  BROWSER SYNC
gulp.task('browserSync', function() {
  browserSync({server: {baseDir: dest}});
});

//  PUG
gulp.task('pug', function() {
  return gulp.src(root+'/pug/public/*.pug')
    .pipe(pug({
      pretty: true
     }))
    .pipe(gulp.dest(dest));
});

//  BABEL
gulp.task('babel', function() {
  return gulp.src(babelSrc)
    .pipe(babel())
    .pipe(concat(file+'.js'))
    .pipe(banner(comment, {pkg:pkg}))
    .pipe(gulp.dest(dest+'/'+assets+'/'+js))

    .pipe(uglify())
    .pipe(banner(comment, {pkg:pkg}))
    .pipe(rename({extname:'.'+min+'.js'}))
    .pipe(gulp.dest(dest+'/'+assets+'/'+js));
});

//  IMAGES
gulp.task('img', function() {
  return gulp.src(root+'/img/**/*')
    .pipe(gulp.dest(dest+'/'+assets+'/'+img));
});

//  PHP
gulp.task('php', function() {
  return gulp.src(root+'/php/**/*')
    .pipe(gulp.dest(dest+'/'+assets+'/'+php));
});

//  WATCH
gulp.task('watch', function() {
  gulp.watch(root+'/pug/**/*', ['pug', browserSync.reload]);
  gulp.watch(root+'/babel/**/*', ['babel', browserSync.reload]);
  gulp.watch(root+'/php/**/*', ['php', browserSync.reload]);
  gulp.watch(root+'/img/**/*', ['img', browserSync.reload]);
});

//  DEFAULT
gulp.task('default', function() {
  runSequence(['del', 'pug', 'babel', 'img', 'php', 'browserSync', 'watch']);
});
