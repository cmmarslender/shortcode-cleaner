module.exports = {
	minify: {
		expand: true,

		cwd: 'assets/css/',
		src: ['style.css'],

		dest: 'assets/css/',
		ext: '.min.css'
	}
};