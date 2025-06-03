<?php

class PublicationModel extends Dbh {
    protected function setPublication(
        $reference,
        $titre,
        $auteurs,
        $soumisPar,
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
            $sql = "INSERT INTO `publications` (`id`, `reference`, `titre`, `auteurs`, `soumis_par`, `lieu`, `doi`, `date`, `type`, `numero`, `volume`, `attestation`, `publication`, `rapport`, `thesard_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([
                $reference,
                $titre,
                $auteurs,
                $soumisPar,
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

    protected function updatePublication(
        $id,
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
    ) {
        $publicationPath = "";
        $attestationPath = "";
        $rapportPath = "";
        if (!empty($publication)) {
            $publicationPath = "uploads/publications/" . $publication["name"];
        }
        if (!empty($attestation)) {
            $attestationPath = "uploads/attestations/" . $attestation["name"];
        }
        if (!empty($rapport)) {
            $rapportPath = "uploads/rapports/" . $rapport["name"];
        }
        $sql = "
            UPDATE publications 
            SET 
                reference = :reference,
                titre = :titre,
                auteurs = :auteurs,
                lieu = :lieu,
                doi = :doi,
                date = :date,
                type = :type,
                numero = :numero,
                volume = :volume"
                . (!empty($publicationPath) ? ", publication = :publicationPath" : "")
                . (!empty($attestationPath) ? ", attestation = :attestationPath" : "")
                . (!empty($rapportPath) ? ", rapport = :rapportPath" : "") . "
            WHERE id = :id;
        ";

        try {
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':reference', $reference);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteurs', $auteurs);
            $stmt->bindParam(':lieu', $lieu);
            $stmt->bindParam(':doi', $doi);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':volume', $volume);

            if (isset($publicationPath)) {
                $stmt->bindParam(':publicationPath', $publicationPath);
            }
            if (isset($attestationPath)) {
                $stmt->bindParam(':attestationPath', $attestationPath);
            }
            if (isset($rapportPath)) {
                $stmt->bindParam(':rapportPath', $rapportPath);
            }

            $stmt->execute();
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

    protected function getPublicationTitleById($publication_id) {
        try {
            $sql = "SELECT titre FROM publications WHERE id = ?;";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$publication_id])) {
                throw new Exception("Database query execution failed.");
            }

            $result = $stmt->fetch();
            return $result["titre"];
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

    protected function getPublicationsByFilter($searchQuery, $filter) {
        $sql = "";

        switch ($filter) {
            case "titre":
                $sql = "SELECT * FROM publications WHERE titre LIKE ?;";
                break;
            case "thesard":
                $sql = "SELECT * FROM publications WHERE soumis_par LIKE ?;";
                break;
            case "auteurs":
                $sql = "SELECT * FROM publications WHERE auteurs LIKE ?;";
                break;
            case "doi":
                $sql = "SELECT * FROM publications WHERE doi LIKE ?;";
                break;
            case "reference":
                $sql = "SELECT * FROM publications WHERE reference LIKE ?;";
                break;
        }

        try {
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            $searchTerm = '%' . $searchQuery . '%';
            if (!$stmt->execute([$searchTerm])) {
                throw new Exception("Database query execution failed.");
            }

            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getPublicationsByFilterAndThesardId($searchQuery, $filter, $thesard_id) {
        $sql = "";

        switch ($filter) {
            case "titre":
                $sql = "SELECT * FROM publications WHERE titre LIKE ? AND thesard_id = ?;";
                break;
            case "thesard":
                $sql = "SELECT * FROM publications WHERE soumis_par LIKE ? AND thesard_id = ?;";
                break;
            case "auteurs":
                $sql = "SELECT * FROM publications WHERE auteurs LIKE ? AND thesard_id = ?;";
                break;
            case "doi":
                $sql = "SELECT * FROM publications WHERE doi LIKE ? AND thesard_id = ?;";
                break;
            case "reference":
                $sql = "SELECT * FROM publications WHERE reference LIKE ? AND thesard_id = ?;";
                break;
        }

        try {
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            $searchTerm = '%' . $searchQuery . '%';
            if (!$stmt->execute([$searchTerm, $thesard_id])) {
                throw new Exception("Database query execution failed.");
            }

            $result = $stmt->fetchAll();
            return $result;
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
