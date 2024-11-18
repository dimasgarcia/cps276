<?php
require_once 'classes/Date_time.php';

$dt = new Date_time();
$message = isset($_POST['addNote']) ? $dt->addNote() : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Add Note</h1>
    <a href="displayNotes.php?begDate=1900-01-01&endDate=<?php echo date('Y-m-d'); ?>">View Notes</a>
    <form method="post">
        <p class="<?php echo !empty($message) && strpos($message, 'success') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </p>
        <label for="dateTime">Date and Time:</label>
        <input type="datetime-local" id="dateTime" name="dateTime" class="form-control">
        <label for="note">Note:</label>
        <textarea id="note" name="note" class="form-control"></textarea>
        <button type="submit" name="addNote">Add Note</button>
    </form>
</body>
</html>
