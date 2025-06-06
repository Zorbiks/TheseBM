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
        } elseif(count($args) === 5) {
            $this->handleFiveParameter($args[0], $args[1], $args[2], $args[3], $args[4]);
        } else {
            throw new InvalidArgumentException('Invalid number of arguments passed to constructor');
        }
    }

    // Set ID for deletion
    public function handleOneParameter($id) {
        $this->id = $id;
    }

    // Set thesard details for account creation
    private function handleFourParameter($firstName, $lastName, $email, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    // Update thesard details
    private function handleFiveParameter($id, $firstName, $lastName, $email, $password) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    // Add new account after validation checks
    public function add() {
        if ($this->isEmptyInputWhenAdding()) {
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
        
        // Initialize mail service with user info and send confirmation email
        $mailService = new MailService($this->firstName, $this->lastName, $this->email);
        $mailService->sendMail();
    }

    // Update thesard info by ID
    public function modify() {
        if ($this->isEmptyInputWhenUpdating()) {
            header("location: gestion-des-thesards.php?action=modify&error=emptyInput");
            exit();
        }
        if ($this->isEmailInvalid()) {
            header("location: gestion-des-thesards.php?action=modify&error=emailInvalid");
            exit();
        }
        if (!empty($this->password)) {
            if ($this->passwordMinLength()) {
                header("location: gestion-des-thesards.php?action=modify&error=passwordLength");
                exit();
            }
        }

        // Proceed with modifying the account if all validations pass
        $this->updateAccount($this->id, $this->firstName, $this->lastName, $this->email, $this->password);
    }

    // Delete an account by ID
    public function delete() {
        $this->deleteAccount($this->id);
    }

    // Check for any empty input fields
    private function isEmptyInputWhenAdding() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->password)
        );
    }

    private function isEmptyInputWhenUpdating() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email)
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