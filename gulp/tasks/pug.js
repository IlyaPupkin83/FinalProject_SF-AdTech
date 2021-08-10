const {
	src,
	dest
} = require('gulp');

const sourcemaps = require('gulp-sourcemaps');

const pug = require('gulp-pug');
const beautify = require('gulp-beautify');
const rename = require('gulp-rename');
const dom = require('gulp-dom');
const replace = require('gulp-string-replace');

const replaceOptions = {
	logs: {
		enabled: false,
		notReplaced: false
	}
}

function page() {
	return src([
			'./src/pug/**/*.pug',
			'!./src/pug/menu/*.pug'
		])

		.pipe(pug({
			pretty: true
		}))
		.pipe(dom(function () {
			const forms = this.querySelectorAll('form');

			if (!forms) return this;

			for (const form of forms) {
				if (form.getAttribute('method') == 'POST') form.setAttribute('enctype', 'multipart/form-data');

				if (form.querySelector('input[name="csrf"') || form.getAttribute('method') == 'GET') continue;

				const hidden = this.createElement('input');
				hidden.setAttribute('type', 'hidden');
				hidden.setAttribute('name', 'csrf');
				hidden.setAttribute('value', "<?= $props['token'] ?>")

				form.append(hidden);

			};

			return this;

		}))
		.pipe(replace(new RegExp('</?html>|</?head>|</?body>', 'g'), ''), replaceOptions)
		.pipe(replace(new RegExp('<!--\\?', 'g'), '<?'), replaceOptions)
		.pipe(replace(new RegExp('\\?-->', 'g'), '?>'), replaceOptions)
		.pipe(beautify.html({
			indent_size: 4
		}))
		.pipe(rename(function (path) {
			path.extname = '.php';
		}))
		.pipe(dest('../code/app/get/'))
}

function menu() {
	return src([
			'./src/pug/menu/*.pug'
		])
		.pipe(pug({
			pretty: true
		}))
		.pipe(beautify.html({
			indent_size: 4
		}))
		.pipe(rename(function (path) {
			path.dirname = '';
			path.extname = '.php';
		}))
		.pipe(dest('../code/app/templates/menu/'))
}

module.exports = {
	page,
	menu
};