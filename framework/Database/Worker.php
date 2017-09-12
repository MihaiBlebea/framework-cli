<?php

namespace InstaRouter\Database;


/**
* This class is all about migrations and database controller
*
* @package    my-package
* @subpackage my-subpackage
* @author    Serban Blebea
* @version    my-version
**/

class Worker
{
    private static $instance;

    public $servername;
    public $database;
    public $username;
    public $password;

    public $conn;
    public $blueprints = array();

    public function __construct()
    {
        global $app;
        $this->servername = $app->config['database']['servername'];
        $this->database = $app->config['database']['database'];
        $this->username = $app->config['database']['username'];
        $this->password = $app->config['database']['password'];

        $this->conn = $this->connect();
    }

    public static function getInstance() {
        if (!Worker::$instance instanceof self) {
             Worker::$instance = new self();
        }
        return Worker::$instance;
    }

    public function connect()
    {
        // Create connection
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->conn->connect_error) {
            //die("Connection failed: " . $conn->connect_error);
            return false;
        }
        //echo "Connected successfully";
        return $this->conn;
    }

    public function collectBlueprints(Blueprint ...$blueprint)
    {
        foreach($blueprint as $index => $item)
        {
            array_push($this->blueprints, $item->getPlan());
        }
        return $this->blueprints;
    }

    public function getMigrationsClasses()
    {
        $migrations = array_diff(scandir('../migrations'), array('.', '..'));
        $migrations = array_values($migrations);
        return $migrations;
    }

    public function migrateAll()
    {
        $migrations = $this->getMigrationsClasses();

        foreach($migrations as $index => $migration)
        {
            $migration = rtrim($migration, ".php");
            $this->migrateClassTable($migration);
        }
    }

    public function migrateClassTable($migration)
    {
        if(strpos($migration, ".php") > -1)
        {
            $migration = rtrim($migration, ".php");
        }

        $namespace = '\Migrations\\' . $migration;
        $class = new $namespace();
        $class->up();
    }

    public function dropClassTable($migration)
    {
        if(strpos($migration, ".php") > -1)
        {
            $migration = rtrim($migration, ".php");
        }

        $namespace = '\Migrations\\' . $migration;
        $class = new $namespace();
        $class->drop();
    }

    public function dropAll()
    {
        $migrations = $this->getMigrationsClasses();

        foreach($migrations as $index => $migration)
        {
            $this->dropClassTable($migration);
        }
    }
}
