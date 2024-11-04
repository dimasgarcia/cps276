<?php
require 'pdo_methods.php';

function displayFileList() {
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM uploaded_files";
    $records = $pdo->selectNotBinded($sql);

    if ($records == 'error' || count($records) === 0) {
        return "<li>No files found</li>";
    }

    $output = '';
    foreach ($records as $record) {
        $output .= "<li><a href='serveFile.php?file=" . urlencode(basename($record['file_path'])) . "' target='_blank'>" . htmlspecialchars($record['file_name']) . "</a></li>";
    }

    return $output;
}
