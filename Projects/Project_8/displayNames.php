<?php
header('Content-Type: application/json');
require_once 'Pdo_methods.php';

$pdo = new PdoMethods();
$sql = "SELECT name FROM names ORDER BY name ASC";
$names = $pdo->selectNotBinded($sql);

if ($names == 'error' || empty($names)) {
    echo json_encode(['masterstatus' => 'error', 'msg' => 'No names found']);
} else {
    $output = '';
    foreach ($names as $name) {
        $output .= "<p>{$name['name']}</p>";
    }
    echo json_encode(['masterstatus' => 'success', 'names' => $output]);
}
