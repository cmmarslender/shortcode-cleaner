var autoprefixer = require('autoprefixer');

module.exports = {
	options: {
		map: {
			inline: false,
			annotation: 'assets/css/'
		},
		processors: [
			autoprefixer({
				browsers: ['> 0.5%', 'last 2 versions']
			})
		]
	},
	dist: {
		src: 'assets/css/*.css'
	}
};
