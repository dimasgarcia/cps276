<?php
header('Content-Type: application/json');
require_once 'Pdo_methods.php';

$pdo = new PdoMethods();
$sql = "DELETE FROM names";
$result = $pdo->otherNotBinded($sql);

if ($result === 'noerror') {
    echo json_encode(['masterstatus' => 'success', 'msg' => 'All names were deleted']);
} else {
    echo json_encode(['masterstatus' => 'error', 'msg' => 'Failed to clear names']);
}
