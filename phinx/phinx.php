<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'pgsql',
            'host' => getenv('CI_APP_DB_HOST'),
            'name' => getenv('CI_APP_DB_NAME'),
            'user' => getenv('CI_APP_DB_USER'),
            'pass' => getenv('CI_APP_DB_PASSWORD'),
            'port' => getenv('CI_APP_DB_PORT'),
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'pgsql',
            'host' => getenv('CI_APP_DB_HOST'),
            'name' => getenv('CI_APP_DB_NAME'),
            'user' => getenv('CI_APP_DB_USER'),
            'pass' => getenv('CI_APP_DB_PASSWORD'),
            'port' => getenv('CI_APP_DB_PORT'),
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'pgsql',
            'host' => getenv('CI_APP_DB_HOST'),
            'name' => getenv('CI_APP_DB_NAME'),
            'user' => getenv('CI_APP_DB_USER'),
            'pass' => getenv('CI_APP_DB_PASSWORD'),
            'port' => getenv('CI_APP_DB_PORT'),
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
