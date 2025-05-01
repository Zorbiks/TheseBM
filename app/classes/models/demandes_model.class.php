<?php

class DemandesModel extends Dbh {
    protected function getInactiveAccounts() {
        try {
            $sql = "SELECT id, prenom, nom, email FROM users WHERE active = 0 AND role = 'thesard';";
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

    protected function getThesardInfo($id) {
        try {
            // Query to fetch the user with all required fields
            $sql = "SELECT prenom, nom, email FROM users WHERE id = ?;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            if (!$stmt->execute([$id])) {
                throw new Exception("Database query execution failed.");
            }

            if ($stmt->rowCount() === 0) {
                header("location: ../../public/connexion.php?error=incorrectCredentials");
                exit();
            }

            $user = $stmt->fetch();

            return $user;

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    protected function activateAccount($id) {
        try {
            $sql = "UPDATE users SET active = 1 WHERE users.id = ?;";
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
