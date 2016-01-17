module.exports = {
	allFiles: [
		'assets/css/scss/**/*.scss'
	],
	options: {
		bundleExec: false,
		force: true,
		config: '.scss-lint.yml',
		reporterOutput: 'scss-lint-report.xml',
		colorizeOutput: true,
		exclude: ['assets/css/scss/base/_sanitize.scss']
	}
};
