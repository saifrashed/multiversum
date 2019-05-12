<?php
/**
 * User: saifeddine
 * Date: 2019-03-24
 * Time: 16:23
 */

/**
 * Class handler
 */
class Handler {
    private $host;
    private $dbdriver;
    private $dbname;
    private $username;
    private $password;


    /**
     * handler constructor.
     * Establish a connection with the database by using PDO.
     *
     * @param $host
     * @param $dbdriver
     * @param $dbname
     * @param $username
     * @param $password
     */
    public function __construct() {
        $this->host     = 'localhost';
        $this->dbdriver = 'mysql';
        $this->dbname   = 'multiversum';
        $this->username = 'root';
        $this->password = 'Rashed112';

        try {
            $this->connect = new PDO("$this->dbdriver:host=" . $this->host . "; dbname=" . $this->dbname . "", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            echo "Connection with " . $this->dbdriver . " failed: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->connect = null;
    }

    public function createData($sql) {
        $this->connect->query($sql);
        return $this->connect->lastInsertId();
    }

    public function readsData($sql) {
        $this->connect->query($sql);
        return $this->connect->query($sql, PDO::FETCH_ASSOC);
    }

    public function updateData($sql) {
        $this->connect->query($sql);
    }

    public function deleteData($sql) {
        $result = $this->connect->query($sql);
        return $result->rowCount();
    }

}
