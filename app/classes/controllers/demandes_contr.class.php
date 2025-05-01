<?php

class DemandesContr extends DemandesModel {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function accept() {
        $this->activateAccount($this->id);
        $thesard = $this->getThesardInfo($this->id);
        $mailService = new MailService($thesard["prenom"], $thesard["nom"], $thesard["email"]);
        $mailService->sendMail();
    }

    public function reject() {
        $this->deleteAccount($this->id);
    }
}