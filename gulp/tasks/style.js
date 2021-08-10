const {
	src,
	dest
} = require('gulp');

const sourcemaps = require('gulp-sourcemaps');

const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cleancss = require('gulp-clean-css');

const concat = require('gulp-concat');

function style() {
	return src([
			'./node_modules/normalize.css/normalize.css',
			'./src/sass/**/*.sass',
			'!./src/sass/variables.sass'
		])
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(autoprefixer({
			overrideBrowserslist: ['last 10 versions'],
			grid: true,
			stats: false
		}))
		.pipe(concat('style.css'))
		.pipe(cleancss({
			level: {
				1: {
					specialComments: 0
				}
			},
		}))
		.pipe(sourcemaps.write())
		.pipe(dest('../code/public/css/'))
}

module.exports = {
	style
};