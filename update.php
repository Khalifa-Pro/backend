<?php
   header('Access-Control-Allow-Origin: *'); // Spécifie l'origine autorisée
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Autorise les méthodes HTTP spécifiques
   header('Access-Control-Allow-Headers: Content-Type'); // Autorise les en-têtes spécifiques
   header('Content-Type: application/json'); // Définit le type de contenu de la réponse
    
   include "../backend/db.php";

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = (int) $_POST['age'];

    $stmt = $db->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, age = ? WHERE id = ?");
    $result = $stmt->execute([$nom,$prenom,$age,$id]);

    echo json_encode([
        'success' => $result
    ]);

?>