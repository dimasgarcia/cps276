<?php
if (count($_POST) > 0) {
    require_once 'addNameProc.php';
    $addName = new AddNamesProc();
    $output = $addName->addClearNames();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Names</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Names</h1>
        <form method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <button type="submit" name="add" class="btn btn-primary">Add Name</button>
                <button type="submit" name="clear" class="btn btn-danger">Clear Names</button>
            </div>
            <div class="form-group">
                <label for="namelist">List of Names</label>
                <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo isset($output) ? $output : ''; ?></textarea>
            </div>
        </form>
    </div>
</body>
</html>
