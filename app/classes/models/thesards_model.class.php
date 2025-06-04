<?php

class ThesardsModel extends Dbh {
    // Retrieve all active thesard
    protected function getAllThesards() {
        try {
            $sql = "SELECT prenom, nom, email, id FROM users WHERE role = 'thesard' AND active = 1;";
            $dbh = $this->connect();
            $result = $dbh->query($sql);
            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    // Get the total number of publications associated with a specific thesard by their ID
    protected function getNumberOfPublicationByThesardId($thesard_id) {
        try {
            $sql = "SELECT count(*) AS total FROM publications WHERE thesard_id = :thesard_id;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':thesard_id', $thesard_id);
            $stmt->execute();
    
            $result = $stmt->fetch();
            return $result["total"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }    
}