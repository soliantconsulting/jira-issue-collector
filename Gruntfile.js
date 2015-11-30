module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        phplint: {
            all: [
                'config/**/*.php{,.dist}',
                'src/**/*.{php,phtml}',
                'tests/**/*.{php,phtml}'
            ]
        },
        phpcs: {
            all: {
                src: [
                    'config/',
                    'src/',
                    'tests/'
                ]
            },
            options: {
                // hack: args not directly supported by grunt-phpcs can be added in the bin path
                bin: 'vendor/bin/phpcs -p --extensions=dist,php,phtml',
                standard: 'PSR2',
                encoding: 'utf-8',
                verbose: false
            }
        },
        phpunit: {
            Module: {
                configuration: 'phpunit.xml.dist'
            },
            options: {
                bin: 'vendor/bin/phpunit'
            }
        },
        mkdir: {
            build: {
                options: {
                    create: [
                        'build/logs'
                    ]
                }
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-mkdir');
    grunt.loadNpmTasks('grunt-phpcs');
    grunt.loadNpmTasks("grunt-phplint");
    grunt.loadNpmTasks('grunt-phpunit');

    // Task registration
    grunt.registerTask('default', ['test']);
    grunt.registerTask('test', function (env) {
        if (env === 'ci') {
            // In CI, we want to collect coverage reports
            grunt.task.run(['mkdir:build']);

            var phpunitConfig = grunt.config.get('phpunit');

            for (var property in phpunitConfig) {
                if (property === 'options') {
                    continue;
                }

                phpunitConfig[property].coverageClover = 'build/logs/clover-' + property + '.xml';
            }

            grunt.config.set('phpunit', phpunitConfig)
        }

        grunt.task.run(['phplint', 'phpcs', 'phpunit']);
    });
};
