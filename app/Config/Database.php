<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';
    
    

    /**
     * The default database connection.
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => '127.0.0.1',
        'username'     => 'root',
        'password'     => 'q',
        'database'     => 'tpsitcom',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => array(),
        'port'         => 3306,
        'save_queries' => true
    ];
    /*public $db["default"] = array(
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => 'q',
        'database'     => 'tpsitcom',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => array(),
        'port'         => 3306,
        'save_queries' => true
    );*/

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    /*public array $tests = [
        'DSN'          => 'MySQLi://root:q@127.0.0.1:3306/tpsitcom',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => 'q',
        'database'     => 'tpsitcom',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => true,
        'DBDebug'      => false,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => true,
    ];*/

    public function __construct()
    {
        //return mysqli("localhost","root","q","tpsitcom");
        parent::__construct();
        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        /*if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'default'; //'tests';
        }*/
    }
}
