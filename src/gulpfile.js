'use strict';

var gulp        = require('gulp'),
    watch       = require('gulp-watch'),
    uglify      = require('gulp-uglify'),
    rigger      = require('gulp-rigger'),
    sourcemaps  = require('gulp-sourcemaps'),
    plumber     = require('gulp-plumber'),
    babel       = require('gulp-babel'),
    concat      = require('gulp-concat'),
    clean       = require('gulp-clean');

var path = {
    build: {
        clean: 'moodle/static/**/*.*',
        js: 'moodle/static/js/'
    },
    src: {
        js: 'assets/js/*.*'
    },
    watch: {
        js: 'assets/js/*.*',
        all: 'assets/**/*.*'
    }
};


gulp.task('js:build', function () {
    return gulp.src(path.src.js)
        .pipe(plumber())
        .pipe(rigger())
        .pipe(sourcemaps.init())
        .pipe(babel({ presets: ['@babel/env']}))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(plumber.stop())
        .pipe(concat('all.js'))
        .pipe(gulp.dest(path.build.js))
});

gulp.task('watch', function(){
    watch([path.watch.all], gulp.series('clean','build'))
});
gulp.task('clean', function () {
    return gulp.src(path.build.clean, {read: false})
        .pipe(clean());
});

gulp.task('build', gulp.series('clean', 'js:build'));
gulp.task('default',  gulp.series('build'));
