<?php

class Dbh {
    protected function connect() {
        try {
            // Get database connection details from environment variables
            $db_host     = getenv("DB_HOST");
            $db_username = getenv("DB_USERNAME");
            $db_password = getenv("DB_PASSWORD");
            $db_name     = getenv("DB_NAME");

            // Build DSN string for MySQL connection
            $dsn = "mysql:host=$db_host;dbname=$db_name";
            $dbh = new PDO($dsn, $db_username, $db_password);
            
            // Set error mode to exception for better error handling
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Set fetch mode to associative arrays by default
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Return the PDO connection object
            return $dbh;
        } catch (PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
            die();
        }
    }
}
