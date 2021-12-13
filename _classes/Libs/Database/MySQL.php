<?php

namespace Libs\Database;

use PDO;
use PDOException;

class MySQL
{
    private $db;
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpwd;

    function __construct(
        $dbhost = "localhost",
        $dbname = "project",
        $dbuser = "root",
        $dbpwd = "root"
    ) {
        $this->db = null;
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->dbpwd = $dbpwd;
    }

    function connect()
    {
        try {
            $this->db = new PDO(
                "mysql:dbhost=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpwd,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );

            return $this->db;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
