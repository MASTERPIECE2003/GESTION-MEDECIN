<?php

require 'connexionDB.php';

// Vérifier si la requête est une requête POST
header('Content-Type: application/json');

// Récupérer les données du corps de la requête JSON
$data = json_decode(file_get_contents('php://input'), true);
$res['error'] = true;

if ($data != NULL) {
    $nom = $data['nom'];
    $nombre_jours = $data['nombre_jours'];
    $taux_journalier = $data['taux_journalier'];
    $request = "INSERT INTO medecin (nom, nombre_jours, taux_journalier) VALUES ('$nom', '$nombre_jours', '$taux_journalier')";

    if ($conn->query($request) === TRUE) {
        $res['error'] = false;
        $res['message'] = "Médecin ajouté(e) avec succès !";
    } else {
        $res['message'] = "Echec de l'ajout !";
        $res['errorMessage'] = "Error: " . $request . "\n" . $conn->error;
    }
    $conn->close();

} else {
    $res['message'] = "Erreur de requête !";
}

print(json_encode($res));
?>