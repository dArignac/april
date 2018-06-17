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
        dist_target: 'april/',
        clean: ['april'],
        copy: {
            theme: {
                files: [
                    {expand: true, src: 'content/**', dest: '<%= dist_target %>'},
                    {expand: true, src: 'include/**', dest: '<%= dist_target %>'},
                    {expand: true, src: 'languages/*.mo', dest: '<%= dist_target %>'},
                    {expand: true, src: 'menu/*.php', dest: '<%= dist_target %>'},
                    {expand: true, src: '*.php', dest: '<%= dist_target %>'},
                    {expand: true, src: '*.jpg', dest: '<%= dist_target %>'},
                    {expand: true, src: 'LICENSE', dest: '<%= dist_target %>'}
                ]
            },
            components: {
                files: [
                    {expand: false, src: 'node_modules/font-awesome/css/font-awesome.min.css', dest: '<%= dist_target %>css/font-awesome.min.css'},
                    {expand: true, src: '**', 'cwd': 'node_modules/font-awesome/fonts', dest: '<%= dist_target %>fonts/'},
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
                    '<%= dist_target %>style.css': 'sass/style.scss'
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
                    '<%= dist_target %>style.css': ['<%= dist_target %>style.css']
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
                    src: ['<%= dist_target %>style.css']
                }
            }
        },
        concat: {
            bootstrap: {
                src: [
                    'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
                    'js/<%= pkg.name %>.js'
                ],
                dest: '<%= dist_target %>js/<%= pkg.name %>.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= pkg.version %>, created <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: '<%= dist_target %>js/<%= pkg.name %>.js',
                dest: '<%= dist_target %>js/<%= pkg.name %>.js'
            }
        },
        sed: {
            fontawesome: {
                path: '<%= dist_target %>functions.php',
                pattern: '/node_modules/font-awesome/css/font-awesome.css',
                replacement: '/css/font-awesome.min.css'
            },
            tether: {
                path: '<%= dist_target %>functions.php',
                pattern: 'wp_enqueue_script\\( \'tether\', get_template_directory_uri\\(\\) . \'/node_modules/tether/dist/js/tether.js\', array\\(\'jquery\'\\), null, false \\);',
                replacement: ''
            },
            bootstrap: {
                path: '<%= dist_target %>functions.php',
                pattern: 'wp_enqueue_script\\( \'bootstrap\', get_template_directory_uri\\(\\) . \'/node_modules/bootstrap/dist/js/bootstrap.js\', array\\(\'jquery\', \'tether\'\\), null, false \\);',
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