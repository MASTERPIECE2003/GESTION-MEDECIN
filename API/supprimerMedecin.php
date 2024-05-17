<?php

require 'connexionDB.php';

$request = json_decode(file_get_contents('php://input'));

$res['error'] = true;

if ($request != NULL) {
    $numed = $request->numed;
    $sql = "DELETE FROM medecin WHERE numed = '".$numed."'";
       if ($conn->query($sql) === TRUE) {  
        $res['error'] = false;
        $res['message'] = "Suppression bien effectué !";
       }  
       else {
        $res['message'] = "Echec de la suppression !";
        $res['errorMessage'] = "Error: " . $request . "\n" . $conn->error;
       }
       $conn->close();
}else {
    $res['message'] = "Une erreur de requet !";
}

print(json_decode($res));


?>