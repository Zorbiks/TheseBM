<?php

class Dbh {
    protected function connect() {
        try {
            $db_host = getenv("DB_HOST");
            $db_username = getenv("DB_USERNAME");
            $db_password = getenv("DB_PASSWORD");
            $db_name = getenv("DB_NAME");


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
