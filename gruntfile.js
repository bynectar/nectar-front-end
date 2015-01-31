module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        assemble: {
            options: {
                layout: 'page.hbs',
                layoutdir: './src/templates/layouts',
                partials: './src/templates/partials/**/*.hbs',
                plugins: ['permalinks']
            },
            site: {
                files: [{
                    cwd: './src/views/',
                    dest: './',
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
                    "./css/main.css": "./src/less/main.less"
                }
            }
        },
        watch: {
            scripts: {
                files: ['**/*.hbs'],
                tasks: ['assemble','less'],
                options: {
                    spawn: false,
                },
            },
        },
    });

    // Load handlebars template compiler
    grunt.loadNpmTasks('assemble');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');

    // Default task(s).
    grunt.registerTask('default', ['assemble','less']);

};