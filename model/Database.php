<?php
class Database{
    private $host = "localhost";
    private $dbname = "aulaprogweb";
    private $user = "root";
    private $password = "";
    private $conn;

    public function getConnection(): mixed {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password );

            $this->conn->exec(statement: "set names utf8");


        }
        catch (PDOException $erro) {
            echo "erro na conexao: " . $erro->getMessage();
        }
        return $this->conn;
    }
}
?>