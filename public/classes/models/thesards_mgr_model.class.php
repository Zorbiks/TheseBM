<?php

class ThesardsMgrModel extends Dbh {
    protected function getActiveAccounts() {
        try {
            $sql = "SELECT id, prenom, nom, email FROM users WHERE active = 1 AND role = 'thesard';";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute()) {
                throw new Exception("Database query execution failed.");
            }

            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    protected function deleteAccount($id) {
        try {
            $sql = "DELETE FROM users WHERE users.id = ?";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$id])) {
                throw new Exception("Database query execution failed.");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
