<?php
if (isset($_GET['file'])) {
    $filePath = "/tmp/testdocuments/" . basename($_GET['file']);
    
    // to check if the file exists
    if (file_exists($filePath)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"" . basename($filePath) . "\"");
        header("Content-Length: " . filesize($filePath));

        readfile($filePath);
        exit;
    } else {
        echo "Error: File not found at $filePath";
    }
} else {
    echo "Error: No file specified.";
}
