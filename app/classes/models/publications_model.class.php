<?php

class PublicationModel extends Dbh {
    protected function setPublication(
        $reference,
        $titre,
        $auteurs,
        $lieu,
        $doi,
        $date,
        $type,
        $numero,
        $volume,
        $publication,
        $attestation,
        $rapport,
        $thesard_id
    ) {
        try {
            $sql = "INSERT INTO `publications` (`id`, `reference`, `titre`, `auteurs`, `lieu`, `doi`, `date`, `type`, `numero`, `volume`, `attestation`, `publication`, `rapport`, `thesard_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([
                $reference,
                $titre,
                $auteurs,
                $lieu,
                $doi,
                $date,
                $type,
                $numero,
                $volume,
                "uploads/attestations/" . $attestation,
                "uploads/publications/" . $publication,
                "uploads/rapports/" . $rapport,
                $thesard_id
            ])) {
                throw new Exception("Database query execution failed.");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getPublicationsByThesardId($thesard_id) {
        try {
            $sql = "SELECT * FROM publications WHERE thesard_id = ?;";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$thesard_id])) {
                throw new Exception("Database query execution failed.");
            }

            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getAllPublications() {
        try {
            $sql = "SELECT * FROM publications;";

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

    protected function deletePublication($id) {
        try {
            $sql = "DELETE FROM publications WHERE id = ?;";

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
