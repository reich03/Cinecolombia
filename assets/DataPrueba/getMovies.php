<?php
header('Content-Type: application/json');
require_once './Movies.php';
echo json_encode($movies);
?>
