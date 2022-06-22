<?php
/**
 * Database Configuration
 *
 * All of your system's database connection settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/DbConfig.php.
 *
 * @see craft\config\DbConfig
 */

use config\Env;

return [

    'driver' => Env::DB_DRIVER,
    'server' => Env::DB_SERVER,
    'port' => Env::DB_PORT,
    'database' => Env::DB_DATABASE,

    'charset' => Env::DB_CHARSET,
    'collation' => Env::DB_COLLATION,

    'schema' => Env::DB_SCHEMA,
    'tablePrefix' => Env::DB_TABLEPREFIX,

    'user' => Env::DB_USER,
    'password' => Env::DB_PASSWORD,

];
