<?php

class ThesardsMgrContr extends ThesardsMgrModel {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    // Constructor "overloading" using variable number of arguments
    public function __construct(...$args) {
        if (count($args) === 1) {
            $this->handleOneParameter($args[0]);
        } elseif(count($args) === 4) {
            $this->handleFourParameter($args[0], $args[1], $args[2], $args[3]);
        }
    }

    // Set ID for deletion
    public function handleOneParameter($id) {
        $this->id = $id;
    }

    // Set user details for account creation
    private function handleFourParameter($firstName, $lastName, $email, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    // Add new account after validation checks
    public function add() {
        if ($this->isEmptyInput()) {
            header("location: gestion-des-thesards.php?action=add&error=emptyInput");
            exit();
        }
        if ($this->isEmailInvalid()) {
            header("location: gestion-des-thesards.php?action=add&error=emailInvalid");
            exit();
        }
        if ($this->isEmailTaken()) {
            header("location: gestion-des-thesards.php?action=add&error=emailTaken");
            exit();
        }
        if ($this->passwordMinLength()) {
            header("location: gestion-des-thesards.php?action=add&error=passwordLength");
            exit();
        }

        // Proceed with setting the account if all validations pass
        $this->setAccount($this->firstName, $this->lastName, $this->email, $this->password);
    }

    // Delete an account by ID
    public function delete() {
        $this->deleteAccount($this->id);
    }

    // ----------- Validation methods -----------

    // Check for any empty input fields
    private function isEmptyInput() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->password)
        );
    }

    // Validate email format
    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Check if password is shorter than 8 characters
    private function passwordMinLength() {
        return strlen($this->password) < 8;
    }

    // Check if the email already exists in the database
    private function isEmailTaken() {
        return $this->emailExists($this->email);
    }
}