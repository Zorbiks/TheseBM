<?php

class DashboardModel extends Dbh {
    /**
     * Returns statistics on the number of publications by type, including total count.
     *
     * @return array Associative array of publication counts.
     *               Example: [
     *                   'conference' => 5,
     *                   'chapitre' => 1,
     *                   'communication' => 3,
     *                   'total' => 9
     *               ]
     */
    protected function getPublicationStats() {
        try {
            $dbh = $this->connect();

            // Publication types to count
            $types = ["conference", "chapitre", "communication"];
            $stats = [];

            foreach ($types as $type) {
                $stmt = $dbh->prepare("SELECT COUNT(*) AS total FROM publications WHERE type = ?");
                $stmt->execute([$type]);
                $result = $stmt->fetch();
                $stats[$type] = $result["total"];
            }

            // Total count of all publications
            $stmtTotal = $dbh->query("SELECT COUNT(*) AS total FROM publications");
            $totalResult = $stmtTotal->fetch();
            $stats["total"] = $totalResult["total"];

            return $stats;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getNumberOfThesards() {
        try {
            $sql = "SELECT active, COUNT(*) AS total FROM users WHERE role = 'thesard' GROUP BY active;";
            $dbh = $this->connect();
            $stmt = $dbh->query($sql);
            $results = $stmt->fetchAll();

            // Prepare counts with default 0
            $counts = [
                'active' => 0,
                'inactive' => 0,
            ];

            foreach ($results as $row) {
                if ($row['active'] == 1) {
                    $counts['active'] = $row['total'];
                } else {
                    $counts['inactive'] = $row['total'];
                }
            }

            return $counts;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return ['active' => 0, 'inactive' => 0];
        }
    }
    
    protected function setJournal($thesard_id, $action, $publication_id) {
        try {
            $sql = "INSERT INTO journal (thesard_id, action, publication_id, date) VALUES (?, ?, ?, current_timestamp())";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Close the connection and stop the script on failure
            if (!$stmt->execute([$thesard_id, $action, $publication_id])) {
                throw new Exception("Database query execution failed.");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function getJournal() {
        try {
            $sql = "SELECT * FROM journal;";
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

    protected function getThesardFullNameById($thesard_id) {
        try {
            $sql = "SELECT prenom, nom FROM users WHERE id = ?;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Close the connection and stop the script on failure
            if (!$stmt->execute([$thesard_id])) {
                throw new Exception("Database query execution failed.");
            }
    
            $results = $stmt->fetch();
            if ($results) {
                return $results['prenom'] . ' ' . $results['nom'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    protected function getPublicationTitleById($publication_id) {
        try {
            $sql = "SELECT titre FROM publications WHERE id = ?;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
    
            // Execute the statement
            if (!$stmt->execute([$publication_id])) {
                throw new Exception("Database query execution failed.");
            }
    
            $result = $stmt->fetch();
    
            if ($result) {
                return $result['titre'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}
