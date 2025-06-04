<?php

class ThesardsMgrModel extends Dbh {
    protected function getActiveAccounts() {
        try {
            $sql = "SELECT id, prenom, nom, email FROM users WHERE active = 1 AND role = 'thesard';";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function emailExists($email) {
        try {
            $sql = "SELECT email FROM users WHERE email = :email;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            return ($stmt->rowCount() === 1);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function setAccount($firstName, $lastName, $email, $password) {
        try {
            $sql = "INSERT INTO users (id, prenom, nom, email, password, role, active) 
                    VALUES (NULL, :firstName, :lastName, :email, :password, 'thesard', 1);";
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Bind parameters using named placeholders
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    protected function deleteAccount($id) {
        try {
            $sql = "DELETE FROM users WHERE users.id = :id";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}
