<?php

/**
 * Class Database - PDO database class.
 * Connects to the database.
 * Creates prepared statements.
 * Bind values.
 * Return rows and results.
 */
class Database {
    private $host;
    private $user;
    private $password;
    private $dbName;

    private $pdo;
    private $statement;
    private $error;

    /**
     * Database constructor. Connects to the database.
     */
    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->password = DB_PASS;
        $this->dbName = DB_NAME;

        //Set DSN
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Create PDO instance;
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepares statement.
     * @param $sql - SQL query
     */
    public function query($sql) {
        $this->statement = $this->pdo->prepare($sql);
    }

    /**
     * Binds user input to PDO placeholder.
     * @param $param - named parameter / PDO placeholder
     * @param $value string - actual user input value
     * @param null $type
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_string($value):
                    $type = PDO::PARAM_STR;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared statement.
     * @return bool
     */
    public function execute() {
        return $this->statement->execute();
    }

    /**
     * Get result as an array of objects.
     * @return array
     */
    public function getMultipleObjects() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as object.
     * @return mixed object
     */
    public function getSingleObj() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Counts rows.
     * @return mixed int
     */
    public function rowCount() {
        return $this->statement->rowCount();
    }
}