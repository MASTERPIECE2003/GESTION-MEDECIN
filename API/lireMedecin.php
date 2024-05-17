<?php

require'connexionDB.php';
header('Content-Type: application/json');

$result = $conn->query('SELECT * FROM medecin') ;
$res['error'] = true;
$medecins = array();
while($row = $result->fetch_assoc()){
    array_push($medecins, $row);
    $res['error'] = false;
}
$res['medecins'] = $medecins;

print(json_encode($res));
?>