<?php
header('Access-control-Allow-Origin: *');
header('Access-control-Allow-Methods: GET, PUT, DELETE, OPTIONS');
header('Access-control-Allow-Max-Age: 3600');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cookie, Accept');
header('Access-control-Allow-Credentials: true');

$conn = new mysqli("localhost", "root", "", "medecin");
if ($conn->connect_error) {
    die("Database connection Failed !");
}
?>
