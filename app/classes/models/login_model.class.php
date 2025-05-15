<?php

class LoginModel extends Dbh {
    protected function getUser($email, $password) {
        try {
            // Query to fetch the user with all required fields
            $sql = "SELECT id, prenom, nom, password, role, active FROM users WHERE email = ?;";
            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);

            if (!$stmt->execute([$email])) {
                throw new Exception("Database query execution failed.");
            }

            if ($stmt->rowCount() === 0) {
                header("location: connexion.php?error=incorrectCredentials");
                exit();
            }

            $user = $stmt->fetch();
            
            if (!$user || !password_verify($password, $user['password'])) {
                header("location: connexion.php?error=incorrectCredentials");
                exit();
            }

            if ($user["active"] === 0) {
                header("location: connexion.php?error=notActive");
                exit();
            }

            // Start session
            session_start();

            $_SESSION["id"] = $user["id"];
            $_SESSION["firstName"] = $user["prenom"];
            $_SESSION["lastName"] = $user["nom"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["active"] = $user["active"];

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
