<?php

class SignupModel extends Dbh {
    protected function setUser($firstName, $lastName, $email, $password) {
        try {
            $sql = "INSERT INTO users (id, prenom, nom, email, password, role, active) VALUES (NULL, ?, ?, ?, ?, 'thesard', 0);";
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$firstName, $lastName, $email, $hashedPassword])) {
                throw new Exception("Database query execution failed.");
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    protected function emailExists($email) {
        try {
            $sql = "SELECT email FROM users WHERE email = ?;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$email])) {
                throw new Exception("Database query execution failed.");
            }

            if ($stmt->rowCount() === 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
