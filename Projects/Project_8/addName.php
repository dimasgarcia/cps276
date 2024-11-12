<?php
header('Content-Type: application/json');
require_once 'Pdo_methods.php';

// Decode JSON from $_POST['data']
$data = isset($_POST['data']) ? json_decode($_POST['data'], true) : null;

// to check if data was received and decoded properly
if (!$data) {
    echo json_encode(['masterstatus' => 'error', 'msg' => 'No data received']);
    exit;
}

// to validate name input
if (!isset($data['name']) || trim($data['name']) === '') {
    echo json_encode(['masterstatus' => 'error', 'msg' => 'You must enter a name']);
    exit;
}

// Split the full name into first and last names
$fullName = explode(' ', trim($data['name']));
if (count($fullName) < 2) {
    echo json_encode(['masterstatus' => 'error', 'msg' => 'Please enter both first and last name']);
    exit;
}

$firstName = $fullName[0];
$lastName = $fullName[1];
$formattedName = "$lastName, $firstName";

//  to log formatted name for debugging
error_log("Formatted name to insert: " . $formattedName);

// to insert the formatted name into the database
$pdo = new PdoMethods();
$sql = "INSERT INTO names (name) VALUES (:name)";
$bindings = [
    [':name', $formattedName, 'str']
];

// To try inserting and log the result
$result = $pdo->otherBinded($sql, $bindings);

// to check if insertion was successful
if ($result === 'noerror') {
    echo json_encode(['masterstatus' => 'success', 'msg' => 'Name has been added']);
} else {
    // to log the error for debugging
    error_log("Database insert error in addName.php: Failed to add name to the database.");
    echo json_encode(['masterstatus' => 'error', 'msg' => 'Failed to add name to the database']);
}
