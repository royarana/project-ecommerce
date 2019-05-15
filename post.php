<?php 

$content = trim(file_get_contents('php://input'));
$decoded = json_decode($content, true);

echo json_encode($decoded);
?>