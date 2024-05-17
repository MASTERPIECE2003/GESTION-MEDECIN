<?php

require 'connexionDB.php';

// Vérifier si la requête est une requête POST
header('Content-Type: application/json');

// Récupérer les données du corps de la requête JSON
$data = json_decode(file_get_contents('php://input'), true);
$res['error'] = true;

if ($data != NULL) {
    $id = $data['id']; // Remplacez 'id' par le nom de la colonne d'identification de votre table
    $nom = $data['nom'];
    $nombre_jours = $data['nombre_jours'];
    $taux_journalier = $data['taux_journalier'];

    $request = "UPDATE medecin SET nom = '$nom', nombre_jours = '$nombre_jours', taux_journalier = '$taux_journalier' WHERE id = $id";

    if ($conn->query($request) === TRUE) {
        $res['error'] = false;
        $res['message'] = "Modification réussie !";
    } else {
        $res['message'] = "Echec de la modification !";
        $res['errorMessage'] = "Error: " . $request . "\n" . $conn->error;
    }
} else {
    $res['message'] = "Erreur";
}

$conn->close();

echo json_encode($res);
?>