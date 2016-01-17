module.exports = {
	all: {
		files: {
			'assets/js/main.min.js': ['assets/js/main.js']
		},
		options: {
			mangle: {
				except: ['jQuery']
			}
		}
	}
};