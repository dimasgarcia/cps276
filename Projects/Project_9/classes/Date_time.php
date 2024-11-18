<?php
require_once 'PdoMethods.php';

class Date_time {
    private $pdo;

    public function __construct() {
        $this->pdo = new PdoMethods();
    }

    public function addNote() {
        if (empty($_POST['dateTime']) || empty($_POST['note'])) {
            return "You must enter a date, time, and note.";
        }

        $timestamp = date('Y-m-d H:i:s', strtotime($_POST['dateTime']));
        $note = htmlspecialchars($_POST['note'], ENT_QUOTES);

        $sql = "INSERT INTO note (date_time, note) VALUES (:dateTime, :note)";
        $bindings = [
            [':dateTime', $timestamp, 'str'],
            [':note', $note, 'str']
        ];

        $result = $this->pdo->otherBinded($sql, $bindings);
        return $result === 'noerror' ? "Note added successfully." : "There was an error adding the note.";
    }

    public function getNotes() {
        if (empty($_POST['begDate']) || empty($_POST['endDate'])) {
            return "You must enter both a beginning and ending date.";
        }

        $begDate = date('Y-m-d 00:00:00', strtotime($_POST['begDate']));
        $endDate = date('Y-m-d 23:59:59', strtotime($_POST['endDate']));

        $sql = "SELECT date_time, note FROM note WHERE date_time BETWEEN :begDate AND :endDate ORDER BY date_time DESC";
        $bindings = [
            [':begDate', $begDate, 'str'],
            [':endDate', $endDate, 'str']
        ];

        $records = $this->pdo->selectBinded($sql, $bindings);
        if ($records === 'error' || empty($records)) {
            return "<p>No notes found for the selected date range.</p>";
        }

        $output = "<table class='table'>";
        $output .= "<thead><tr><th>Date and Time</th><th>Note</th></tr></thead><tbody>";
        foreach ($records as $row) {
            $formattedDate = date('m/d/Y h:i a', strtotime($row['date_time']));
            $output .= "<tr><td>{$formattedDate}</td><td>{$row['note']}</td></tr>";
        }
        $output .= "</tbody></table>";
        return $output;
    }
}
