const gulp = require("gulp");

//html
const fileInclude = require("gulp-file-include"); //вставка хедеров футеров
const htmlclean = require("gulp-htmlclean"); // html minify
const webpHTML = require("gulp-webp-html"); //преобразование картинок в webp

//css
const sass = require("gulp-sass")(require("sass"));
const sourceMaps = require("gulp-sourcemaps");
// const groupMedia = require("gulp-group-css-media-queries");
const autoprefixer = require("gulp-autoprefixer");
const csso = require("gulp-csso"); // плагин для минификации css
const webpCss = require("gulp-webp-css"); //преобразование картинок в webp

const server = require("gulp-server-livereload"); //server autoreload
const clean = require("gulp-clean"); //очистка папки
const fs = require("fs"); // доступ к файловой системе
const webpack = require("webpack-stream");
const babel = require("gulp-babel");

//images
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");

const changed = require("gulp-changed");

gulp.task("html:docs", () => {
  return gulp
    .src("./src/*.html")
    .pipe(changed("./docs/", { hasChanged: changed.compareContents }))
    .pipe(
      fileInclude({
        prefix: "@@",
        basepath: "@file",
      })
    )
    .pipe(webpHTML())
    .pipe(htmlclean())
    .pipe(gulp.dest("./docs/"));
});

gulp.task("sass:docs", () => {
  return (
    gulp
      .src("./src/scss/*.scss")
      .pipe(changed("./docs/css/"))
      .pipe(sourceMaps.init())
      .pipe(sass())
      // .pipe(groupMedia())
      .pipe(webpCss())
      .pipe(autoprefixer())
      .pipe(csso())
      .pipe(sourceMaps.write())
      .pipe(gulp.dest("./docs/css/"))
  );
});

gulp.task("images:docs", () => {
  return gulp
    .src("./src/img/**/*")
    .pipe(changed("./docs/img/"))
    .pipe(webp())
    .pipe(gulp.dest("./docs/img/"))
    .pipe(gulp.src("./src/img/**/*"))
    .pipe(changed("./docs/img/"))
    .pipe(imagemin({ verbose: true }))
    .pipe(gulp.dest("./docs/img/"));
});

gulp.task("fonts:docs", () => {
  return gulp.src("./src/fonts/**/*").pipe(gulp.dest("./docs/fonts/"));
});

gulp.task("js:docs", () => {
  return gulp
    .src("./src/js/*.js")
    .pipe(changed("./docs/js/"))
    .pipe(babel())
    .pipe(webpack(require("../webpack.config.js")))
    .pipe(gulp.dest("./docs/js/"));
});

gulp.task("jQuery:docs", () => {
  return gulp.src("./src/js/jquery-3.2.1.min.js").pipe(gulp.dest("./docs/js/"));
});

gulp.task("server:docs", () => {
  return gulp.src("./docs/").pipe(
    server({
      livereload: true,
      open: true,
    })
  );
});

gulp.task("clean:docs", (done) => {
  if (fs.existsSync("./docs/")) {
    return gulp.src("./docs/", { read: false }).pipe(clean({ force: true }));
  }
  done();
});
