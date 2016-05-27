'use strict';

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.name %> <%= pkg.version %>, created <%= grunt.template.today("yyyy-mm-dd") %> */\n',
        clean: ['dist'],
        copy: {
            theme: {
                files: [
                    {expand: true, src: 'content/**', dest: 'dist/'},
                    {expand: true, src: 'include/**', dest: 'dist/'},
                    {expand: true, src: 'languages/*.mo', dest: 'dist/'},
                    {expand: true, src: '*.php', dest: 'dist/'},
                    {expand: true, src: '*.jpg', dest: 'dist/'},
                    {expand: true, src: 'LICENSE', dest: 'dist/'}
                ]
            },
            components: {
                files: [
                    {expand: false, src: 'bower_components/font-awesome/css/font-awesome.min.css', dest: 'dist/css/font-awesome.min.css'},
                    {expand: true, src: '**', 'cwd': 'bower_components/font-awesome/fonts', dest: 'dist/fonts/'}
                ]
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compact',
                    sourcemap: 'none'
                },
                files: {
                    'dist/style.css': 'sass/style.scss'
                }
            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'dist/style.css': ['dist/style.css']
                }
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= pkg.version %>, created <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'js/<%= pkg.name %>.js',
                dest: 'dist/js/<%= pkg.name %>.js'
            }
        },
        sed: {
            functions: {
                path: 'dist/functions.php',
                pattern: '/bower_components/font-awesome/css/font-awesome.css',
                replacement: '/css/font-awesome.min.css'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-sed');

    grunt.registerTask('default', ['clean', 'copy', 'sass', 'cssmin', 'uglify', 'sed:functions']);
};