'use strict';

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.name %> <%= pkg.version %>, created <%= grunt.template.today("yyyy-mm-dd") %> */\n',
        bannerwordpress: '/*\n' +
            'Theme Name: April\n' +
            'Theme URI: https://github.com/dArignac/april\n' +
            'Author: Alexander Herrmann\n' +
            'Author URI: https://github.com/dArignac\n' +
            'Description: Themes based on Bootstrap 4\n' +
            'Version: <%= pkg.version %>\n' +
            'License: MIT\n' +
            'License URI: http://choosealicense.com/licenses/mit/\n' +
            'Tags: april, bootstrap, responsive\n' +
            'Text Domain: april\n\n' +
            'Simple responsive theme based on Bootstrap 4.0\n' +
            '*/',
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
        // Worpress version information is within the style.css...
        usebanner: {
            dist: {
                options: {
                    position: 'top',
                    banner: '<%= bannerwordpress %>'
                },
                files: {
                    src: ['dist/style.css']
                }
            }
        },
        concat: {
            bootstrap: {
                src: [
                    'bower_components/bootstrap/js/dist/util.js',
                    'bower_components/bootstrap/js/dist/carousel.js',
                    'bower_components/bootstrap/js/dist/collapse.js',
                    'js/<%= pkg.name %>.js'
                ],
                dest: 'dist/js/<%= pkg.name %>.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= pkg.version %>, created <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'dist/js/<%= pkg.name %>.js',
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
                pattern: 'wp_enqueue_script\\( \'tether\', get_template_directory_uri\\(\\) . \'/bower_components/tether/dist/js/tether.js\', array\\(\'jquery\'\\), \'1.2.0\', false \\);',
                replacement: ''
            },
            bootstrap: {
                path: 'dist/functions.php',
                pattern: 'wp_enqueue_script\\( \'bootstrap\', get_template_directory_uri\\(\\) . \'/bower_components/bootstrap/dist/js/bootstrap.js\', array\\(\'jquery\', \'tether\'\\), \'4.0.0a2\', false \\);',
                replacement: ''
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
    grunt.loadNpmTasks('grunt-banner');

    grunt.registerTask('default', ['clean', 'copy', 'sass', 'cssmin', 'usebanner', 'concat', 'uglify', 'sed']);
};