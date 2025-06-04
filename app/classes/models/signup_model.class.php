<?php

class SignupModel extends Dbh {
    protected function setUser($firstName, $lastName, $email, $password) {
        try {
            $sql = "INSERT INTO users (id, prenom, nom, email, password, role, active) 
                    VALUES (NULL, :firstName, :lastName, :email, :password, 'thesard', 0);";
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
    
    protected function emailExists($email) {
        try {
            $sql = "SELECT email FROM users WHERE email = :email;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Bind parameter using a named placeholder
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            return ($stmt->rowCount() === 1);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}
