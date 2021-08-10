const {
	series,
	parallel,
	watch,
	src
} = require('gulp');

const {
	guestjs,
	adminjs,
	advjs,
	webmasterjs
} = require('./tasks/js');

const {
	page,
	menu
} = require('./tasks/pug');

const {
	style
} = require('./tasks/style');

const eslint = require('gulp-eslint');
const {
	results
} = require('gulp-eslint');

function lint() {
	return src('./src/js/**/*.js')
		.pipe(eslint({
			fix: true
		}))
		.pipe(eslint.format())
}

function watcher() {
	watch('./src/pug/menu/*.pug', menu);
	watch(['./src/pug/**/*.pug', '!./src/pug/menu/*.pug'], page);
	watch('./src/sass/**/*.sass', style);

	watch(['./src/js/main.js', './src/js/admin/**/*.js'], adminjs);
	watch(['./src/js/main.js', './src/js/advertiser/**/*.js'], advjs);
	watch(['./src/js/main.js', './src/js/guest/**/*.js'], guestjs);
	watch(['./src/js/main.js', './src/js/webmaster/**/*.js'], webmasterjs);
}

exports.default = series(parallel(guestjs, adminjs, advjs, webmasterjs), parallel(page, menu, style), watcher);
exports.lint = lint;