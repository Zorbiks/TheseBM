<?php

class LoginContr extends LoginModel {

    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser() {
        if ($this->isEmptyInput()) {
            header("location: ../connexion.php?error=emptyInput");
            exit();
        }
        if ($this->isEmailInvalid()) {
            header("location: ../connexion.php?error=emailInvalid");
            exit();
        }

        $this->getUser($this->email, $this->password);
    }

    // Error Handling Methodes
    private function isEmptyInput() {
        return (empty($this->email) || empty($this->password));
    }

    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }
}
