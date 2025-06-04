<?php

class JournalContr extends DashboardModel {
    private $thesardName;
    private $action;
    private $publicationTitle;

    public function __construct($thesardName, $action, $publicationTitle) {
        $this->thesardName = $thesardName;
        $this->action = $action;
        $this->publicationTitle = $publicationTitle;
    }

    // Add a journal entry
    function addJournal() {
        // Insert the journal entry into the database
        $this->setJournal($this->thesardName, $this->action, $this->publicationTitle);
    }
}