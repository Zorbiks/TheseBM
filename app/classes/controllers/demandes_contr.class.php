<?php

class DemandesContr extends DemandesModel {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function accept() {
        $this->activateAccount($this->id);
    }

    public function reject() {
        $this->deleteAccount($this->id);
    }
}