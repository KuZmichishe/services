<?php
namespace Deployer;

require 'recipe/laravel.php';

// Configuration

set('repository', 'git@github.com:KuZmichishe/services.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);
set('default_stage', 'beta');

// Hosts
    
host('kuzmich.xyz')
    ->stage('beta')
    ->set('deploy_path', '/mnt/Files/html/service')
    ->user('pi')
    ->port(2222);


// Tasks

desc('Restart PHP-FPM service');

task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo service php7.0-fpm restart');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
