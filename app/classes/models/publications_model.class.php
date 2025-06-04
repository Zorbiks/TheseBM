<?php

class PublicationModel extends Dbh {
    // Insert a new publication record into the database
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
            $sql = "INSERT INTO `publications` 
                    (`id`, `reference`, `titre`, `auteurs`, `soumis_par`, `lieu`, `doi`, `date`, `type`, `numero`, `volume`, `attestation`, `publication`, `rapport`, `thesard_id`) 
                    VALUES (NULL, 
                            :reference, :titre, :auteurs, :soumis_par, :lieu, :doi, :date, 
                            :type, :numero, :volume, :attestation, :publication, :rapport, :thesard_id)";
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Build file path strings for file-related parameters
            $attestationPath = "uploads/attestations/" . $attestation;
            $publicationPath = "uploads/publications/" . $publication;
            $rapportPath     = "uploads/rapports/" . $rapport;
    
            $stmt->bindParam(':reference', $reference);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteurs', $auteurs);
            $stmt->bindParam(':soumis_par', $soumisPar);
            $stmt->bindParam(':lieu', $lieu);
            $stmt->bindParam(':doi', $doi);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':volume', $volume);
            $stmt->bindParam(':attestation', $attestationPath);
            $stmt->bindParam(':publication', $publicationPath);
            $stmt->bindParam(':rapport', $rapportPath);
            $stmt->bindParam(':thesard_id', $thesard_id);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Update an existing publication record, optionally updating file paths if new files are provided
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
        $rapport
    ) {
        // Prepare file path strings based on input, defaulting to an empty string if the parameter is empty.
        $publicationPath = !empty($publication) ? "uploads/publications/" . $publication["name"] : "";
        $attestationPath = !empty($attestation) ? "uploads/attestations/" . $attestation["name"] : "";
        $rapportPath     = !empty($rapport)     ? "uploads/rapports/" . $rapport["name"] : "";
    
        // Build the SQL UPDATE query dynamically based on which file paths are present

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
            $stmt->bindParam(':publicationPath', $publicationPath);
            $stmt->bindParam(':attestationPath', $attestationPath);
            $stmt->bindParam(':rapportPath', $rapportPath);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Retrieve all publications associated with a specific thesard (user) by their ID
    protected function getPublicationsByThesardId($thesard_id) {
        try {
            $sql = "SELECT * FROM publications WHERE thesard_id = :thesard_id;";
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            
            // Bind the parameter using a named placeholder
            $stmt->bindParam(':thesard_id', $thesard_id);
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch all results and return them
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Get the title ('titre') of a publication by its ID
    protected function getPublicationTitleById($publication_id) {
        try {
            $sql = "SELECT titre FROM publications WHERE id = :publication_id;";
    
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Bind the parameter using a named placeholder.
            $stmt->bindParam(':publication_id', $publication_id);
    
            $stmt->execute();
    
            $result = $stmt->fetch();
            return $result["titre"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Get all publications in the database
    protected function getAllPublications() {
        try {
            $sql = "SELECT * FROM publications;";
            $dbh = $this->connect();
            $result = $dbh->query($sql);
            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Get publications filtered by a search query and a filter type
    protected function getPublicationsByFilter($searchQuery, $filter) {
        switch ($filter) {
            case "titre":
                $sql = "SELECT * FROM publications WHERE titre LIKE :searchTerm;";
                break;
            case "thesard":
                $sql = "SELECT * FROM publications WHERE soumis_par LIKE :searchTerm;";
                break;
            case "auteurs":
                $sql = "SELECT * FROM publications WHERE auteurs LIKE :searchTerm;";
                break;
            case "doi":
                $sql = "SELECT * FROM publications WHERE doi LIKE :searchTerm;";
                break;
            case "reference":
                $sql = "SELECT * FROM publications WHERE reference LIKE :searchTerm;";
                break;
            default:
                // Set a default query or throw an exception if needed.
                throw new Exception("Invalid filter provided.");
        }
    
        try {
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $searchTerm = '%' . $searchQuery . '%';
            $stmt->bindParam(':searchTerm', $searchTerm);
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Get publications filtered by search query, filter type, and a specific thesard ID
    protected function getPublicationsByFilterAndThesardId($searchQuery, $filter, $thesard_id) {
        switch ($filter) {
            case "titre":
                $sql = "SELECT * FROM publications WHERE titre LIKE :searchTerm AND thesard_id = :thesard_id;";
                break;
            case "thesard":
                $sql = "SELECT * FROM publications WHERE soumis_par LIKE :searchTerm AND thesard_id = :thesard_id;";
                break;
            case "auteurs":
                $sql = "SELECT * FROM publications WHERE auteurs LIKE :searchTerm AND thesard_id = :thesard_id;";
                break;
            case "doi":
                $sql = "SELECT * FROM publications WHERE doi LIKE :searchTerm AND thesard_id = :thesard_id;";
                break;
            case "reference":
                $sql = "SELECT * FROM publications WHERE reference LIKE :searchTerm AND thesard_id = :thesard_id;";
                break;
            default:
                throw new Exception("Invalid filter provided.");
        }
    
        try {
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            $searchTerm = '%' . $searchQuery . '%';
    
            // Bind the parameters using named placeholders
            $stmt->bindParam(':searchTerm', $searchTerm);
            $stmt->bindParam(':thesard_id', $thesard_id);
    
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Delete a publication from the database by its ID
    protected function deletePublication($id) {
        try {
            $sql = "DELETE FROM publications WHERE id = :id;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}
