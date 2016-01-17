module.exports = {
	options: {
		require: 'sass-globbing',
		sourceMap: true,
		precision: 5
	},
	all: {
		files: {
			'assets/css/style.css': 'assets/css/scss/style.scss'
		}
	}
};