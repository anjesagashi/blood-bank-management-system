<?php
class Database
{
    private $host = 'localhost';
    private $dbname = 'blood_bank_management_system';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct()
    {
        try {

            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";

            $this->conn = new PDO($dsn, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
