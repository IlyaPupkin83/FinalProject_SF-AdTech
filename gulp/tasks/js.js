const {
	src,
	dest
} = require('gulp');

const webpack = require('webpack-stream');
const rename = require('gulp-rename');

function guestjs() {
	return src([
			'./src/js/guest/entry.js'
		])
		.pipe(webpack(require('../webpack.config.js')))
		.pipe(rename('Guest.js'))
		.pipe(dest('../code/app/templates/scripts/'))
}

function adminjs() {
	return src([
			'./src/js/admin/entry.js'
		])
		.pipe(webpack(require('../webpack.config.js')))
		.pipe(rename('Admin.js'))
		.pipe(dest('../code/app/templates/scripts/'))
}

function advjs() {
	return src([
			'./src/js/advertiser/entry.js'
		])
		.pipe(webpack(require('../webpack.config.js')))
		.pipe(rename('Advertiser.js'))
		.pipe(dest('../code/app/templates/scripts/'))
}

function webmasterjs() {
	return src([
			'./src/js/webmaster/entry.js'
		])
		.pipe(webpack(require('../webpack.config.js')))
		.pipe(rename('Webmaster.js'))
		.pipe(dest('../code/app/templates/scripts/'))
}

module.exports = {
	guestjs,
	adminjs,
	advjs,
	webmasterjs
};