module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        assemble: {
            options: {
                layout: 'page.hbs',
                layoutdir: './src/templates/layouts',
                partials: './src/templates/partials/**/*.hbs',
                plugins: ['permalinks'],
                data: './src/data/testdata.json',
                assets: 'dist'
            },
            site: {
                files: [{
                    cwd: './src/views/',
                    dest: './dist/',
                    expand: true,
                    src: '**/*.hbs'
                }]
            }
        },
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "./dist/css/styles.css": "./src/less/styles.less",
                    "./dist/css/fontawesome.css": "./bower_components/fontawesome/less/font-awesome.less"
                }
            }
        },
        concat: {
            dist: {
                src: ['./src/js/**/*.js'],
                dest: './dist/js/scripts.js'
            }
        },
        jshint: {
            beforeconcat: ['./src/js/**/*.js'],
            afterconcat: ['./dist/js/scripts.js']
        },
        watch: {
            scripts: {
                files: [
                	'**/*.hbs',
                	'./src/{,*/}*.less',
                	'./src/{,*/}*.css',
                	'./src/{,*/}*.js',
                	'./src/{,*/}*.json'
            	],
                tasks: ['assemble','less','concat','jshint'],
                options: {
                    spawn: false,
                    livereload: true
                },
            },
        },
		connect: {
			server: {
				options: {
					livereload:true,
					open: true,
					hostname:'localhost',
					base:'./dist/'
				}
			}
		}
    });

    // Load handlebars template compiler
    grunt.loadNpmTasks('assemble');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-connect');

    // Default task(s).
    grunt.registerTask('default', ['assemble','less','concat','jshint']);
    grunt.registerTask('serve', ['assemble','less','concat','jshint','connect','watch']);

};