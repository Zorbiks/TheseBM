<?php

class Dbh {
    protected function connect() {
        try {
            $dbusername = "root";
            $dbpassword = "";
            $host = "localhost";
            $dbname = "thesebm";


            $dsn = "mysql:host=$host;dbname=$dbname";
            $dbh = new PDO($dsn, $dbusername, $dbpassword);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $dbh;
        } catch (PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
            die();
        }
    }
}
