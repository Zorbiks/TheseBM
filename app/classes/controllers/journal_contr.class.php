<?php

class JournalContr extends DashboardModel {
    private $thesard_id;
    private $action;
    private $publication_id;

    public function __construct($thesard_id, $action, $publication_id) {
        $this->thesard_id = $thesard_id;
        $this->action = $action;
        $this->publication_id = $publication_id;
    }

    function addJournal() {
        $this->setJournal($this->thesard_id, $this->action, $this->publication_id);
    }
}