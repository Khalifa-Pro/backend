<?php
    header('Access-Control-Allow-Origin: *'); // Spécifie l'origine autorisée
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Autorise les méthodes HTTP spécifiques
    header('Access-Control-Allow-Headers: Content-Type'); // Autorise les en-têtes spécifiques
    header('Content-Type: application/json'); // Définit le type de contenu de la réponse
    
    include "../backend/db.php";
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = (int) $_POST['age'];

    $stmt = $db->prepare("INSERT INTO utilisateur (nom, prenom, age) VALUES (?,?,?)");
    $result = $stmt->execute([$nom,$prenom,$age]);

    echo json_encode([
        'success' => $result
    ]);

?>