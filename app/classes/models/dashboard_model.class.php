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

            // Define publication types to count
            $types = ["conference", "chapitre", "communication", "journal"];
            $stats = [];

            $stmt = $dbh->prepare("SELECT COUNT(*) AS total FROM publications WHERE type = :type");
            foreach ($types as $type) {
                $stmt->bindParam(':type', $type);
                $stmt->execute();
                $result = $stmt->fetch();
                $stats[$type] = $result["total"];
            }

            // Total number of publications regardless of type
            $stmtTotal = $dbh->query("SELECT COUNT(*) AS total FROM publications");
            $totalResult = $stmtTotal->fetch();
            $stats["total"] = $totalResult["total"];

            return $stats;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Returns the count of thesards grouped by their active status.
    protected function getNumberOfThesards() {
        try {
            $sql = "SELECT active, COUNT(*) AS total FROM users WHERE role = 'thesard' GROUP BY active;";
            $dbh = $this->connect();
            $stmt = $dbh->query($sql);
            $results = $stmt->fetchAll();

            // Initialize counts with default 0 values
            $counts = [
                'active'   => 0,
                'inactive' => 0,
            ];

            // Iterate through result rows and assign counts based on active status
            foreach ($results as $row) {
                // Using strict comparison for clarity
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

    // Inserts a new journal entry to track actions performed on publications
    protected function setJournal($thesard, $action, $publication) {
        try {
            $sql = "INSERT INTO journal (thesard, action, publication, date) 
                    VALUES (:thesard, :action, :publication, current_timestamp())";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            $stmt->bindParam(':thesard', $thesard);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':publication', $publication);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Retrieves all entries from the journal table
    protected function getJournal() {
        try {
            $sql = "SELECT * FROM journal;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
