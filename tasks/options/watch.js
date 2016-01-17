module.exports = {
	sass: {
		files: ['assets/css/scss/**/*.scss'],
		tasks: ['sass', 'postcss', 'cssmin'],
		options: {
			debounceDelay: 500
		}
	},
	scripts: {
		files: ['assets/js/src/**/*.js', 'assets/js/vendor/**/*.js'],
		tasks: ['jshint', 'concat', 'uglify'],
		options: {
			debounceDelay: 500
		}
	}
};