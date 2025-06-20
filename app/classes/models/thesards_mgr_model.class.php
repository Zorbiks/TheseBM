<?php

class ThesardsMgrModel extends Dbh {
    // Retrieve all active 'thesard' accounts with selected fields
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

    // Insert a new active thesard account with hashed password
    protected function setAccount($firstName, $lastName, $email, $password) {
        try {
            $sql = "INSERT INTO users (id, prenom, nom, email, password, role, active) 
                    VALUES (NULL, :firstName, :lastName, :email, :password, 'thesard', 1);";
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Update thesard account with hashed password
    protected function updateAccount($id, $firstname, $lastname, $email, $password) {
        try {
            $sql = "UPDATE users
                    SET
                        prenom = :firstname,
                        nom = :lastname,
                        email = :email"
                        . (!empty($password) ? ", password = :password" : "")
                        . " WHERE id = :id;";
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            if (!empty($password)) {
                $stmt->bindParam(":password", $hashedPassword);
            }
            $stmt->bindParam(":id", $id);            

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Delete a user account by its ID
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

    // Check if a given email already exists in the users table
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
}
