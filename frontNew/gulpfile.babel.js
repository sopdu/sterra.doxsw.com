const { src, dest, watch, series, parallel } = require('gulp');
const browserSync = require('browser-sync').create();
const pug = require('gulp-pug');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const del = require('del');

function assets() {
  return src('src/img/**/*.*')
    .pipe(dest('dist/img'))
    .pipe(browserSync.stream());
}

exports.assets = assets;

function backend() {
  return src('src/backend/**/*.*')
    .pipe(dest('dist/backend'))
    .pipe(browserSync.stream());
}
function plugins() {
  return src('src/plugins/**/*.*')
    .pipe(dest('dist/plugins'))
    .pipe(browserSync.stream());
}

exports.backend = backend;

function html() {
  return src('src/pug/*.pug')
    .pipe(
      pug({
        pretty: true
      })
    )
    .pipe(dest('dist/'))
    .pipe(browserSync.stream());
}

exports.html = html;

function css() {
    return src('src/css/main.css')
        .pipe(dest('dist/css'))
        .pipe(browserSync.stream());
}

exports.css = css;

function scss() {
  return src('src/scss/style.scss')
    .pipe(
      sass({
        outputStyle: 'expanded'
      }).on('error', sass.logError)
    )
    .pipe(dest('dist/css'))
    .pipe(browserSync.stream());
}

exports.scss = scss;

function js() {
  return src(['src/js/utils/*.js', 'src/js/components/*.js', 'src/js/parts/*.js', 'src/js/script.js', 'src/js/pages/*.js', 'src/js/end.js'])
    .pipe(
      babel({
        presets: ['@babel/preset-env']
      })
    )
    .pipe(concat('script.js'))
    .pipe(dest('dist/js/'))
    .pipe(browserSync.stream());
}

exports.js = js;

function clean(cb) {
  return del(['./dist/']);
}

function myServer() {
  browserSync.init({
    server: {
      baseDir: 'dist' // папка для локального сервера
    },
    notify: false
  });

  watch('src/**/*.pug', { usePolling: true }, html);
  watch('src/**/*.html', { usePolling: true }, html);
  watch('src/scss/**/*.scss', { usePolling: true }, scss);
  watch('src/css/**/*.css', { usePolling: true }, css);
  watch('src/js/**/*.js', { usePolling: true }, js);
  watch('src/img/**/*.*', { usePolling: true }, assets);
  watch('src/backend/**/*.*', { usePolling: true }, backend);
  watch('src/plugins/**/*.*', { usePolling: true }, plugins);
}

exports.default = series(clean, assets, backend, plugins, css, scss, js,  html, myServer);
