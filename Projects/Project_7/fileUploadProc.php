<?php
require 'pdo_methods.php';

$uploadMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    $fileName = $_POST['fileName'];
    $file = $_FILES['fileToUpload'];

    // Check file type and size
    if ($file['type'] != 'application/pdf') {
        $uploadMessage = "File must be a PDF file.";
    } elseif ($file['size'] > 100000) {
        $uploadMessage = "File is too big.";
    } else {
        // to set the directory to /tmp/testdocuments (writable by PHP)
        $targetDir = "/tmp/testdocuments/";

        // t check if the directory exists; create it if not
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($file['name']);

        // to move the file
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $uploadMessage = "File has been added.";
            $pdo = new PdoMethods();
            $sql = "INSERT INTO uploaded_files (file_name, file_path) VALUES (:fileName, :filePath)";
            $bindings = [
                [':fileName', $fileName, 'str'],
                [':filePath', $targetFile, 'str']  // for storing the /tmp path
            ];
            $result = $pdo->otherBinded($sql, $bindings);
            if ($result !== 'noerror') {
                $uploadMessage = "Error adding file to the database.";
            }
        } else {
            $uploadMessage = "Error: Unable to move file to $targetFile.";
        }
    }
}

echo $uploadMessage;
