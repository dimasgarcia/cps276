<?php

$mainListItems = 4;
$subListItems = 5;  

// Function to generate nested list
function generateNestedList($main, $sub) {
    $html = '<ul style="list-style-type: disc;">';  // Main list with bullet points
    for ($i = 1; $i <= $main; $i++) {
        $html .= "<li>$i<ul style='list-style-type: circle;'>";  // Sublist with circle bullets
        for ($j = 1; $j <= $sub; $j++) {
            $html .= "<li>$j</li>";
        }
        $html .= '</ul></li>';
    }
    $html .= '</ul>';
    return $html;
}

// The nested list HTML
$nestedListHTML = generateNestedList($mainListItems, $subListItems);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nested List Example</title>
</head>
<body>
    <?php
    // nested list
    echo $nestedListHTML;
    ?>
</body>
</html>
