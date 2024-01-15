const gulp = require("gulp");
const fileInclude = require("gulp-file-include");
const sass = require("gulp-sass")(require("sass"));
const server = require("gulp-server-livereload");
const clean = require("gulp-clean");
const fs = require("fs");
const sourceMaps = require("gulp-sourcemaps");
const webpack = require("webpack-stream");
const babel = require("gulp-babel");
const imagemin = require("gulp-imagemin");
const changed = require("gulp-changed");
var gutil = require("gulp-util");
const ftp = require("vinyl-ftp");

gulp.task("html:dev", () => {
  return gulp
    .src("./src/*.html")
    .pipe(changed("./build/", { hasChanged: changed.compareContents }))
    .pipe(
      fileInclude({
        prefix: "@@",
        basepath: "@file",
      })
    )
    .pipe(gulp.dest("./build/"));
});

gulp.task("sass:dev", () => {
  return gulp
    .src("./src/scss/*.scss")
    .pipe(changed("./build/css/"))
    .pipe(sourceMaps.init())
    .pipe(sass())
    .pipe(sourceMaps.write())
    .pipe(gulp.dest("./build/css/"));
});

gulp.task("images:dev", () => {
  return gulp
    .src("./src/img/**/*")
    .pipe(changed("./build/img/"))
    .pipe(imagemin({ verbose: true }))
    .pipe(gulp.dest("./build/img/"));
});

gulp.task("fonts:dev", () => {
  return gulp.src("./src/fonts/**/*").pipe(gulp.dest("./build/fonts/"));
});

gulp.task("js:dev", () => {
  return gulp
    .src("./src/js/*.js")
    .pipe(changed("./build/js/"))
    .pipe(babel())
    .pipe(webpack(require("./../webpack.config.js")))
    .pipe(gulp.dest("./build/js/"));
});

gulp.task("jQuery:dev", () => {
  return gulp
    .src("./src/js/jquery-3.2.1.min.js")
    .pipe(gulp.dest("./build/js/"));
});

gulp.task("server:dev", () => {
  return gulp.src("./build/").pipe(
    server({
      livereload: true,
      open: true,
    })
  );
});

gulp.task("clean:dev", (done) => {
  if (fs.existsSync("./build/")) {
    return gulp.src("./build/", { read: false }).pipe(clean({ force: true }));
  }
  done();
});

gulp.task("php:dev", () => {
  return gulp
    .src("./src/**/*.php")
    .pipe(changed("./build/"))
    .pipe(gulp.dest("./build/"));
});

gulp.task("deploy", () => {
  const conn = ftp.create({
    host: "bohohome.ru",
    user: "u2076368",
    password: "oqomK2SX1X5a2p6b",
    parallel: 10,
    maxConnections: 5,
    log: gutil.log,
    reload: true,
  });

  const prog = ["build/**/*.*", "!build/fonts/**/*.*", "!build/*.html"];

  return gulp
    .src(prog, { buffer: false })
    .pipe(conn.newer("www/kiosk.bohohome.ru/wp-content/themes/kiosk/"))
    .pipe(conn.dest("www/kiosk.bohohome.ru/wp-content/themes/kiosk/"));
});

gulp.task("watch:dev", () => {
  gulp.watch("./src/scss/**/*.scss", gulp.series("sass:dev", "deploy"));
  gulp.watch("./src/**/*.html", gulp.parallel("html:dev"));
  gulp.watch("./src/img/**/*", gulp.series("images:dev", "deploy"));
  gulp.watch("./src/fonts/**/*", gulp.parallel("fonts:dev"));
  gulp.watch("./src/js/**/*.js", gulp.series("js:dev", "deploy"));
  gulp.watch("./src/**/*.php", gulp.series("php:dev", "deploy"));
});
