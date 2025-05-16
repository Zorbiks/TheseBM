<?php

class ThesardsModel extends Dbh {
    protected function getAllThesards() {
        try {
            $sql = "SELECT prenom, nom, email, id FROM users WHERE role = 'thesard' AND active = 1;";

            $dbh = $this->connect();
            $result = $dbh->query($sql);

            // Close the connection and stop the script on failure
            if (!$result) {
                throw new Exception("Database query execution failed.");
            }

            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getNumberOfPublicationByThesardId($thesard_id) {
        try {
            $sql = "SELECT count(*) AS total FROM publications WHERE thesard_id = ?;";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$thesard_id])) {
                throw new Exception("Database query execution failed.");
            }

            $result = $stmt->fetch();
            return $result["total"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}