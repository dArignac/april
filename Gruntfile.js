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
                    {expand: true, src: 'menu/*.php', dest: 'dist/'},
                    {expand: true, src: '*.php', dest: 'dist/'},
                    {expand: true, src: '*.jpg', dest: 'dist/'},
                    {expand: true, src: 'LICENSE', dest: 'dist/'}
                ]
            },
            components: {
                files: [
                    {expand: false, src: 'bower_components/font-awesome/css/font-awesome.min.css', dest: 'dist/css/font-awesome.min.css'},
                    {expand: true, src: '**', 'cwd': 'bower_components/font-awesome/fonts', dest: 'dist/fonts/'},
                    {expand: false, src: 'bower_components/tether/dist/js/tether.js', dest: 'dist/js/tether.js'},
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
        concat: {
            bootstrap: {
                src: [
                    'bower_components/bootstrap/js/dist/util.js',
                    'bower_components/bootstrap/js/dist/collapse.js'
                ],
                dest: 'dist/js/bootstrap.js'
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
            fontawesome: {
                path: 'dist/functions.php',
                pattern: '/bower_components/font-awesome/css/font-awesome.css',
                replacement: '/css/font-awesome.min.css'
            },
            tether: {
                path: 'dist/functions.php',
                pattern: '/bower_components/tether/dist/js/tether.js',
                replacement: '/js/tether.js'
            },
            bootstrap: {
                path: 'dist/functions.php',
                pattern: '/bower_components/bootstrap/dist/js/bootstrap.js',
                replacement: '/js/bootstrap.js'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-sed');

    grunt.registerTask('default', ['clean', 'copy', 'sass', 'cssmin', 'concat', 'uglify', 'sed']);
};