<?php

class DemandesModel extends Dbh {
    protected function getInactiveAccounts() {
        try {
            $sql = "SELECT id, prenom, nom, email FROM users WHERE active = 0 AND role = 'thesard';";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    protected function getThesardInfo($id) {
        try {
            $sql = "SELECT prenom, nom, email FROM users WHERE id = :id;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() === 0) {
                header("location: connexion.php?error=incorrectCredentials");
                exit();
            }
            
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
    
    protected function activateAccount($id) {
        try {
            $sql = "UPDATE users SET active = 1 WHERE users.id = :id;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    protected function deleteAccount($id) {
        try {
            $sql = "DELETE FROM users WHERE users.id = :id;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}
