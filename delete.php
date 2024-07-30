<?php
    header('Access-Control-Allow-Origin: *'); // Spécifie l'origine autorisée
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Autorise les méthodes HTTP spécifiques
    header('Access-Control-Allow-Headers: Content-Type'); // Autorise les en-têtes spécifiques
    header('Content-Type: application/json'); // Définit le type de contenu de la réponse
    include "../backend/db.php";
    include "../backend/db.php";

    $id = (int) $_GET['id'];

    $stmt = $db->prepare("DELETE FROM utilisateur WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode([
        'success' => $result
    ]);

?>