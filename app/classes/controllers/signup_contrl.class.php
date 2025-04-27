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

    public function signupUser() {
        if ($this->isEmptyInput()) {
            header("location: ../../public/inscription.php?error=emptyInput");
            exit();
        }
        if ($this->isEmailInvalid()) {
            header("location: ../../public/inscription.php?error=emailInvalid");
            exit();
        }
        if ($this->passwordDontMatch()) {
            header("location: ../../public/inscription.php?error=passwordDontMatch");
            exit();
        }
        if ($this->passwordLength()) {
            header("location: ../../public/inscription.php?error=passwordLength");
            exit();
        }
        if ($this->isEmailTaken()) {
            header("location: ../../public/inscription.php?error=emailTaken");
            exit();
        }

        $this->setUser($this->firstName, $this->lastName, $this->email, $this->password);
    }

    // Error Handling Methodes
    private function isEmptyInput() {
        return (
            empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->password) || 
            empty($this->passwordRepeat)
        );
    }

    private function isEmailInvalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function passwordDontMatch() {
        return ($this->password !== $this->passwordRepeat);
    }

    private function passwordLength() {
        return strlen($this->password) < 8 || strlen($this->password) > 24;
    }

    private function isEmailTaken() {
        return $this->emailExists($this->email);
    }
}
