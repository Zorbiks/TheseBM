<?php

class LoginContr extends LoginModel {

    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    // Method to log in the user
    public function loginUser() {
        // Check if email or password fields are empty
        if ($this->isEmptyInput()) {
            header("location: connexion.php?error=emptyInput");
            exit();
        }

        // Check if email format is invalid
        if ($this->isEmailInvalid()) {
            header("location: connexion.php?error=emailInvalid");
            exit();
        }

        // Attempt to fetch and validate the user
        $this->getUser($this->email, $this->password);
    }

    // Checks if input fields are empty
    private function isEmptyInput() {
        return (empty($this->email) || empty($this->password));
    }

    // Validates email format
    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }
}
