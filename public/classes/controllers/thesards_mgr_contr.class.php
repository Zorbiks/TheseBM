<?php

class ThesardsMgrContr extends ThesardsMgrModel {
    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    public function delete() {
        $this->deleteAccount($this->id);
    }
}