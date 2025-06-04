<?php

class SignupModel extends Dbh {
    // Insert a new user into the 'users' table with hashed password and default role 'thesard'
    protected function setUser($firstName, $lastName, $email, $password) {
        try {
            $sql = "INSERT INTO users (id, prenom, nom, email, password, role, active) 
                    VALUES (NULL, :firstName, :lastName, :email, :password, 'thesard', 0);";

            // Hash the plain text password securely before storing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // Check if a given email already exists in the users table
    protected function emailExists($email) {
        try {
            $sql = "SELECT email FROM users WHERE email = :email;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            // Return true if exactly one row is found (email exists), false otherwise
            return ($stmt->rowCount() === 1);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}
