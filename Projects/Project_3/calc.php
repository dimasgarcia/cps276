<?php
require_once "Calculator.php"; 

$Calculator = new Calculator();  
$result = "";

// Test cases for the calc method
$result .= $Calculator->calc("*", 10, 2);
$result .= $Calculator->calc("*", 4.56, 2);
$result .= $Calculator->calc("/", 10, 2);
$result .= $Calculator->calc("/", 10, 3);
$result .= $Calculator->calc("/", 10, 0);
$result .= $Calculator->calc("/", 0, 10);
$result .= $Calculator->calc("-", 10, 2);
$result .= $Calculator->calc("-", 10, 20);
$result .= $Calculator->calc("+", 10.5, 2);
$result .= $Calculator->calc("+", 10.5, 0);
$result .= $Calculator->calc("*", 10);  // Error: Missing second number
$result .= $Calculator->calc("+", "a", 10);  // Error: First argument not numeric
$result .= $Calculator->calc("+", 10, "a");  // Error: Second argument not numeric
$result .= $Calculator->calc(10);  // Error: Missing operator

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Output</title>
</head>
<body>
    <h1>Calculator Output</h1>
    <main>
        <?php echo $result; ?>  
    </main>
</body>
</html>
