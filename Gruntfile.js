module.exports = function(grunt) {

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-css');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-clean');

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		clean: {
			build: ["public/css/build", "public/js/build"]
		},
		concat: {
			build: {
				src: ['public/css/DT_bootstrap.css', 'courses.css'],
				dest: 'public/css/build/concat.css'
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build: {
				src: 'public/js/*.js',
				dest: 'public/js/build/<%= pkg.name %>.min.js'
			}
		},
		cssmin: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */'
			},
			build: {
				src: 'public/css/build/concat.css',
				dest: 'public/css/build/<%= pkg.name %>.min.css'
			}
		}
	});

	grunt.registerTask('removeconcat', 'Removes concatted files', function(){
		grunt.file.delete('public/css/build/concat.css');
		grunt.log.writeln('Removed concatted CSS file.');
	});

	// Default task(s).
	grunt.registerTask('default', ['clean','uglify', 'concat', 'cssmin', 'removeconcat']);
};