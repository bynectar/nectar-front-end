'use strict';
var _ = require('lodash');
var path = require('path');

module.exports = function(grunt) {

  // load the blog template from the desired path
  var postTemplate = grunt.file.read('./src/posts/post.hbs');
  
  // expand the data files and loop over each filepath
  var posts = _.flatten(_.map(grunt.file.expand('./src/data/post*.json'), function(filepath) {
    
    // read in the data file
    var data = grunt.file.readJSON(filepath);
    
    // create a 'page' object to add to the 'pages' collection
    return {
      // the filename will determine how the page is named later
      filename: path.basename(filepath, path.extname(filepath)),
      // the data from the json file
      data: data,
      // add the recipe template as the page content
      content: postTemplate
    };
  }));
  
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
        assets: 'dist',
      },
      site: {
        files: [{
          cwd: './src/views/',
          dest: './dist/',
          expand: true,
          src: '**/*.hbs'
        }]
      },
      posts: {
        options: {
          //pages: posts,
          pages: [
            "post-one.html",
            "post-two.html",
            "post-three.html"
          ],
          flatten: true,
          layoutdir: './src/templates/layouts',
          assets: 'dist',
          partials: './src/templates/partials/**/*.hbs'
        },
        files: [{
          dest: './dist/',
          src: '!*'
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
    copy: {
      main: {
        expand: true,
        cwd: './src/assets/',
        src: '**',
        dest: './dist/',
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
  grunt.loadNpmTasks('grunt-contrib-copy');

  // Default task(s).
  grunt.registerTask('default', ['assemble','less','concat','jshint','copy']);
  grunt.registerTask('serve', ['assemble','less','concat','jshint','copy','connect','watch']);

};