/* -- INCLUSION DES MODULES NPM -- */
/**
 * Inclus Gulp (la base sans quoi rien ne marche)
 */
var gulp = require('gulp');
/**
 * Ajoute les préfixes constructeur qui vont bien sur les propriétés CSS
 * https://www.npmjs.com/package/gulp-autoprefixer
 */
var autoprefixer = require('gulp-autoprefixer');
/**
 * Compile les fichiers .scss en .css (utilise libSASS)
 * https://www.npmjs.com/package/gulp-sass
 */
var sass = require('gulp-sass');
/**
 * Permet de lier le code des CSS à leur fichier source SCSS
 * https://www.npmjs.com/package/gulp-sourcemaps
 */
var sourcemaps = require('gulp-sourcemaps');
/**
 * Permet de surveiller la modification des fichiers
 * https://www.npmjs.com/package/gulp-watch
 */
var watch = require('gulp-watch');

/**
 * Détecte d'éventuelles erreurs dans les JS
 * https://www.npmjs.com/package/gulp-jshint
 */
var jshint = require('gulp-jshint');

/**
 * Permet l'actualisation automatique du navigateur
 * https://www.npmjs.com/package/browser-sync
 */
var browserSync = require('browser-sync');
var reload = browserSync.reload;

/* -- CONFIGURATION -- */
var siteUrl = 'http://brickskeeper.dev';
var pathScss = 'web/scss';
var pathCss = 'web/css';
var pathJs = 'web/js';
var pathLibrairies = 'web/librairies';
var pathImg = 'web/img';
// Navigateurs que l'on veut supporter
var autoprefixerBrowsers = [
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4.4',
    'bb >= 10'
];

/* -- TACHES -- */

/**
 * Tâche par défaut, exécute la tâche qui permet l'actualisation automatique du navigateur
 */
gulp.task('default', ['serve']);

/**
 * Actualisation auto du navigateur
 */
gulp.task('serve', ['sass'], function() {
    // Lance le serveur
    browserSync({
        // server: "./" // Lance un serveur statique (html, pas de php)
        proxy: siteUrl // Redirige vers un serveur existant (php ok)
    });
    // Compile les fichier SCSS quand ils sont modifiés
    gulp.watch(pathScss + '/**/*.scss', ['sass']);
    // Traque les erreurs JS
    gulp.watch(pathJs + '/**/*.js', ['jshint']);
    // Actualise la page quand on modifie des fichier HTML
    gulp.watch('**/*.html.twig').on('change', reload);
});

/**
 * Compile le SCSS en CSS et actualise le navigateur
 */
gulp.task('sass', function () {
    return gulp.src(pathScss + '/**/*.scss')
        // Inialisation des sources SCSS
        .pipe(sourcemaps.init())
        // Préfixe les propriétés CSS
        .pipe(autoprefixer({browsers: autoprefixerBrowsers}))
        // Affichage des erreurs s'il y en a
        .pipe(sass().on('error', sass.logError))
        // Ecrit les sources SCSS
        .pipe(sourcemaps.write())
        // Ecrit les fichiers CSS
        .pipe(gulp.dest(pathCss + '/'))
        // Actualise la page
        .pipe(reload({stream: true}));
});

/**
 * Traque les erreurs JS
 */
gulp.task('jshint', function () {
    return gulp.src(pathJs + '/**/*.js')
        .pipe(reload({stream: true, once: true}))
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});