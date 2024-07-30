<?php
    // Ajouter les en-têtes CORS pour autoriser les requêtes provenant de http://localhost:56644
    header('Access-Control-Allow-Origin: *'); // Spécifie l'origine autorisée
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Autorise les méthodes HTTP spécifiques
    header('Access-Control-Allow-Headers: Content-Type'); // Autorise les en-têtes spécifiques
    header('Content-Type: application/json'); // Définit le type de contenu de la réponse
    
    include "../backend/db.php";

    $stmt = $db->prepare("SELECT id, nom, prenom, age FROM utilisateur");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

?>