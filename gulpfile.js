const { src, dest, parallel, watch } = require("gulp");
const concat = require("gulp-concat");
const plumber = require("gulp-plumber");
const browsersync = require("browser-sync").create();

function js() {
    return src([
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/popper.js/dist/umd/popper.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "resources/js/libs/*.js",
        "resources/js/*.js"
    ])
        .pipe(plumber())
        .pipe(concat("app.js"))
        .pipe(dest("public/js"))
}

function css() {
    return src([
        "node_modules/bootstrap/dist/css/bootstrap.min.css",
        "resources/css/libs/*.css",
        "resources/css/*.css"
    ])
        .pipe(plumber())
        .pipe(concat("app.css"))
        .pipe(dest("public/css"))
}

function browserSync(done) {
    browsersync.init({
        proxy: "klibrary.test",
        socket: {
            domain: "localhost:3000"
        }
    });
    done();
}

exports.compile = parallel(js, css);
exports.default = parallel(js, css, browserSync, function() {
    watch("resources/js/*.js", js).on("change", browsersync.reload);
    watch("resources/css/*.css", css).on("change", browsersync.reload);
});
