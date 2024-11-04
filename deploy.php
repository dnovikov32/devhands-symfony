<?php
namespace Deployer;

require 'recipe/common.php';

inventory('servers.yml');

set('application', 'devhands-symfony');
set('repository', 'git@github.com:dnovikov32/devhands-symfony.git');
set('keep_releases', 2);
//set('writable_mode', 'chown');
set('writable_mode', 'chgrp');
set('writable_recursive', true);
set('http_group', 'webuser');

// Shared files/dirs between deploys
set('shared_files', [
    '.env',
]);

// Writable dirs by web server
set('writable_dirs', [
    'var',
]);

/**
 * Saving version of the application
 */
task('save_version', function () {
    run ('cd {{release_path}} && git rev-parse --short HEAD > .version');
})->desc('Saving version');

/**
 * Links from data to web
 */
task('deploy:links', function () {
    run('ln -sf {{deploy_path}}/shared/data/ {{release_path}}/app/web/');
})->desc('Set links for data directory');

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:copy_dirs',
    'deploy:vendors',
    'deploy:links',
    'save_version',
    'deploy:symlink',
    'cleanup'
])->desc('Deploy');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
