<?php

class DatabaseUtils
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect()
    {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '20012001';
        $this->dbname = 'productdb';
        $this->charset = 'utf8mb4';

        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}


//create table product(
//ID int primary key auto_increment,
//SKU nvarchar(255) not null,
//Name nvarchar(255) not null,
//Price float not null,
//Type ENUM ('dvd', 'book', 'furniture') not null,
//MB float,
//KG float,
//Height float,
//Width float,
//Length float,
//unique(SKU)
//);
