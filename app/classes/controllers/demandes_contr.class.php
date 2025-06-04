<?php

class DemandesContr extends DemandesModel {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    // Accept the request: activate the account and send a notification email
    public function accept() {
        // Activate the account in the database
        $this->activateAccount($this->id);

        // Retrieve thesard information based on ID
        // Used for sending an email to thesard
        $thesard = $this->getThesardInfo($this->id);

        // Initialize mail service with user info and send confirmation email
        $mailService = new MailService($thesard["prenom"], $thesard["nom"], $thesard["email"]);
        $mailService->sendMail();
    }

    // Reject the request: delete the account/request from the system
    public function reject() {
        $this->deleteAccount($this->id);
    }
}