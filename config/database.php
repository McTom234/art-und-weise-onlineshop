<?php

use Illuminate\Support\Str;

function env_db_helper($db, $key, $default = null) {
    $key = strtoupper($key);
    $db = strtoupper($db);
    return env("{$db}_DB_$key", env("DB_$key", $default));
}

$DBs = [
    'shared' => [
        'driver' => 'mysql',
        'url' => env_db_helper('SHARED', 'URL'),
        'host' => env_db_helper('SHARED', 'HOST'),
        'port' => env_db_helper('SHARED', 'PORT', '3306'),
        'database' => env_db_helper('SHARED', 'DATABASE', 'art_und_weise'),
        'username' => env_db_helper('SHARED', 'USERNAME', 'art_und_weise'),
        'password' => env_db_helper('SHARED', 'PASSWORD', ''),
        'unix_socket' => env_db_helper('SHARED', 'SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env_db_helper('SHARED', 'MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ],
    'local' => [
        'driver' => 'mysql',
        'url' => env_db_helper('LOCAL', 'URL'),
        'host' => env_db_helper('LOCAL', 'HOST', '127.0.0.1'),
        'port' => env_db_helper('LOCAL', 'PORT', '3306'),
        'database' => env_db_helper('LOCAL', 'DATABASE', 'art_und_weise'),
        'username' => env_db_helper('LOCAL', 'USERNAME', 'art_und_weise'),
        'password' => env_db_helper('LOCAL', 'PASSWORD', ''),
        'unix_socket' => env_db_helper('LOCAL', 'SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env_db_helper('LOCAL', 'MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ],
    'docker' => [
        'driver' => 'mysql',
        'url' => env_db_helper('DOCKER', 'URL'),
        'host' => env_db_helper('DOCKER', 'HOST', '127.0.0.1'),
        'port' => env_db_helper('DOCKER', 'PORT', '13307'),
        'database' => env_db_helper('DOCKER', 'DATABASE', 'art_und_weise'),
        'username' => env_db_helper('DOCKER', 'USERNAME', 'art_und_weise'),
        'password' => env_db_helper('DOCKER', 'PASSWORD', ''),
        'unix_socket' => env_db_helper('DOCKER', 'SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => null,
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env_db_helper('DOCKER', 'MYSQL_ATTR_SSL_CA'),
        ]) : [],
    ]
];

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => array_merge($DBs, [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ]),

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
