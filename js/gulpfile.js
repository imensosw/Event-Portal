// The introduction of plug-ins
var gulp = require('gulp');
var connect = require('gulp-connect');

// Create a task : web server
gulp.task('webserver', function () {
	connect.server({
		port: 8888
	});
});

// Tasks
gulp.task('default', ['webserver']);
