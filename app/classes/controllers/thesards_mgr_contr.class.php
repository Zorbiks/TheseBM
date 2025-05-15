<?php

class ThesardsMgrContr extends ThesardsMgrModel {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    // Constructor "overloading"
    public function __construct(...$args) {
        if (count($args) === 1) {
            $this->handleOneParameter($args[0]);
        } elseif(count($args) === 4) {
            $this->handleFourParameter($args[0], $args[1], $args[2], $args[3]);
        }
    }

    public function handleOneParameter($id) {
        $this->id = $id;
    }

    private function handleFourParameter($firstName, $lastName, $email, $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

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

        $this->setAccount($this->firstName, $this->lastName, $this->email, $this->password);
    }

    public function delete() {
        $this->deleteAccount($this->id);
    }

    // Error Handling Methodes
    private function isEmptyInput() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->password)
        );
    }

    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function passwordMinLength() {
        return strlen($this->password) < 8;
    }

    private function isEmailTaken() {
        return $this->emailExists($this->email);
    }
}