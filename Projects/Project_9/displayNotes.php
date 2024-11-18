<?php
require_once 'classes/Date_time.php';

$dt = new Date_time();
if (isset($_GET['begDate']) && isset($_GET['endDate'])) {
    $_POST['begDate'] = $_GET['begDate'];
    $_POST['endDate'] = $_GET['endDate'];
    $notes = $dt->getNotes();
} else {
    $notes = isset($_POST['getNotes']) ? $dt->getNotes() : "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Display Notes</h1>
    <a href="addNote.php">Add a Note</a>
    <form method="post">
        <label for="begDate">Beginning Date:</label>
        <input type="date" id="begDate" name="begDate" class="form-control" value="<?php echo $_POST['begDate'] ?? ''; ?>">
        <label for="endDate">Ending Date:</label>
        <input type="date" id="endDate" name="endDate" class="form-control" value="<?php echo $_POST['endDate'] ?? ''; ?>">
        <button type="submit" name="getNotes">Get Notes</button>
    </form>
    <?php echo $notes; ?>
</body>
</html>
