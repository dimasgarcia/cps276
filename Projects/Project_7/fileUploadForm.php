<?php
require 'fileUploadProc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">File Upload</h1>
        
        <!-- Success/Error Message -->
        <?php if (isset($uploadMessage) && !empty($uploadMessage)): ?>
            <div class="alert <?php echo (strpos($uploadMessage, 'Error') === false) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $uploadMessage; ?>
            </div>
        <?php endif; ?>

        <!-- the upload Form -->
        <div class="card p-4 mb-4">
            <form action="fileUploadForm.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fileName">File Name</label>
                    <input type="text" name="fileName" id="fileName" class="form-control" required placeholder="Enter file name">
                </div>

                <div class="form-group">
                    <label for="fileToUpload">Choose PDF file</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-file" required>
                </div>

                <button type="submit" name="upload" class="btn btn-primary">Upload File</button>
            </form>
        </div>

        <!-- Link to File List -->
        <a href="listFiles.php" class="btn btn-link">Show File List</a>
    </div>

    <!-- Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
