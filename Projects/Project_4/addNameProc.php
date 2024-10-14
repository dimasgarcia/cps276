<?php
class AddNamesProc {
    private $names = [];

    public function __construct() {
        if (isset($_POST['namelist']) && !empty(trim($_POST['namelist']))) {
            $this->names = explode("\n", trim($_POST['namelist']));
        }
    }

    public function addClearNames() {
        if (isset($_POST['add']) && !empty(trim($_POST['name']))) {
            $name = trim($_POST['name']);
            $this->addName($name);
        } elseif (isset($_POST['clear'])) {
            $this->clearNames();
        }
        return implode("\n", $this->names);
    }

    private function addName($name) {
         // to split the name into first and last name
        list($firstName, $lastName) = explode(" ", $name);
         // to format as lastname, firstname
        $formattedName = "$lastName, $firstName";
        $this->names[] = $formattedName;
         // to sort the names alphabetically
        sort($this->names);
    }

    private function clearNames() {
        $this->names = [];
    }
}
