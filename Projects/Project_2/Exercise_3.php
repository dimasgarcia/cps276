<?php

$rows = 15; 
$cells = 5; 

// Function to generate the table
function generateTable($rows, $cells) {
    $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">'; // Start table
    for ($i = 1; $i <= $rows; $i++) {
        $html .= '<tr>'; // Start row
        for ($j = 1; $j <= $cells; $j++) {
            $html .= "<td>Row $i Cell $j</td>"; // cell with row and cell numbers
        }
        $html .= '</tr>'; // End row
    }
    $html .= '</table>'; // End table
    return $html;
}

// Generated the table HTML
$tableHTML = generateTable($rows, $cells);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <style>
        table {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php
    // The generated table
    echo $tableHTML;
    ?>

</body>
</html>
