<?php

class SignupContr extends SignupModel {

    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $passwordRepeat;

    public function __construct($firstName, $lastName, $email, $password, $passwordRepeat) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    // Main method to handle signup logic with validation
    public function signupUser() {
        if ($this->isEmptyInput()) {
            header("location: inscription.php?error=emptyInput");
            exit();
        }
        if ($this->isEmailInvalid()) {
            header("location: inscription.php?error=emailInvalid");
            exit();
        }
        if ($this->passwordDontMatch()) {
            header("location: inscription.php?error=passwordDontMatch");
            exit();
        }
        if ($this->passwordLength()) {
            header("location: inscription.php?error=passwordLength");
            exit();
        }
        if ($this->isEmailTaken()) {
            header("location: inscription.php?error=emailTaken");
            exit();
        }

        // Create new user if all checks pass
        $this->setUser($this->firstName, $this->lastName, $this->email, $this->password);
    }

    // ----------- Validation methods -----------

    // Check if any input field is empty
    private function isEmptyInput() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->password) || 
            empty($this->passwordRepeat)
        );
    }

    // Validate email format
    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Check if password and confirmation do not match
    private function passwordDontMatch() {
        return ($this->password !== $this->passwordRepeat);
    }

    // Check if password length is not between 8 and 24 characters
    private function passwordLength() {
        return strlen($this->password) < 8 || strlen($this->password) > 24;
    }

    // Check if the email already exists in the database
    private function isEmailTaken() {
        return $this->emailExists($this->email);
    }
}
