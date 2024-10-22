<?php
require_once 'Directories.php'; // to import the class

$msg = "";
$path = "";

// to check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folderName = $_POST['folderName'];
    $fileContent = $_POST['fileContent'];

    $directories = new Directories();
    $result = $directories->createDirectoryWithFile($folderName, $fileContent);

    if ($result['status'] === 'error') {
        $msg = $result['message'];
    } else {
        $msg = "File and directory where created";
        $path = $result['path'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File and Directory Assignment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>File and Directory Assignment</h1>
        <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>

        <?php if ($msg): ?>
            <p><?php echo $msg; ?></p>
        <?php endif; ?>

        <?php if ($path): ?>
            <p><a href="<?php echo $path; ?>" target="_blank">Path where file is located</a></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="folderName">Folder Name</label>
                <input type="text" name="folderName" id="folderName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fileContent">File Content</label>
                <textarea name="fileContent" id="fileContent" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
