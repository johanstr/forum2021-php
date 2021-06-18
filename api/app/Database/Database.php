<?php


namespace App\Database;

use PDO;
use PDOException;

class Database
{
    // Properties
    private $dbHost = '127.0.0.1';          // Localhost
    private $dbName = 'forum_klas1_2021';
    private $dbUser = 'root';
    private $dbPass = 'root';

    private $dbConnection = null;
    private $dbStatement = null;

    // Methods

    /*
     * Constructor
     */
    public function __construct()
    {
        try {
            $this->dbConnection = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPass);
        } catch(PDOException $error) {
            //
        }
    }

    public function query($sql, $args = [])
    {
        if($this->dbConnection) {
            try {
                $this->dbStatement = $this->dbConnection->prepare($sql);
                $this->dbStatement->execute($args);
            } catch(PDOException $error) {
                //
            }
        }
    }

    public function get()
    {
        if($this->dbConnection) {
            if($this->dbStatement) {
                return $this->dbStatement->fetch(PDO::FETCH_ASSOC);
            }
        }

        return [];
    }

    public function getAll()
    {
        if($this->dbConnection) {
            if($this->dbStatement) {
                return $this->dbStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        return [];
    }

    public function insert($sql, $args = [])
    {
        $lastID = 0;

        if($this->dbConnection) {
            $this->dbStatement = $this->dbConnection->prepare($sql);
            $this->dbStatement->execute($args);
            $lastID = $this->dbConnection->lastInsertId();
        }

        return $lastID;
    }
}