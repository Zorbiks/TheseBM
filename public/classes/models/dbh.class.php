<?php

class Dbh {
    protected function connect() {
        try {
            echo $_SERVER["DN_HOST"];
            $db_host = $_SERVER["DB_HOST"];
            $db_username = $_SERVER["DB_USERNAME"];
            $db_password = $_SERVER["DB_PASSWORD"];
            $db_name = $_SERVER["DB_NAME"];


            $dsn = "mysql:host=$db_host;dbname=$db_name";
            $dbh = new PDO($dsn, $db_username, $db_password);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $dbh;
        } catch (PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
            die();
        }
    }
}
