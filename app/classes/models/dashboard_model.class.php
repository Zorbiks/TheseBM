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

            $stmt = $dbh->prepare("SELECT COUNT(*) AS total FROM publications WHERE type = :type");
            foreach ($types as $type) {
                $stmt->bindParam(':type', $type);
                $stmt->execute();
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
                'active'   => 0,
                'inactive' => 0,
            ];

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

    protected function setJournal($thesard, $action, $publication) {
        try {
            $sql = "INSERT INTO journal (thesard, action, publication, date) 
                    VALUES (:thesard, :action, :publication, current_timestamp())";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            // Bind parameters using labels
            $stmt->bindParam(':thesard', $thesard);
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':publication', $publication);

            // Execute the statement; exceptions will be thrown if execution fails.
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

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
