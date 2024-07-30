<?php
   header('Access-Control-Allow-Origin: *'); // Spécifie l'origine autorisée
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Autorise les méthodes HTTP spécifiques
   header('Access-Control-Allow-Headers: Content-Type'); // Autorise les en-têtes spécifiques
   header('Content-Type: application/json'); // Définit le type de contenu de la réponse
   
   include "../backend/db.php";
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($id > 0) {
       // Fetch specific user by ID
       $stmt = $db->prepare("SELECT * FROM utilisateur WHERE id = ?");
       $stmt->execute([$id]);
       $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
       
       if ($utilisateur) {
           echo json_encode($utilisateur);
       } else {
           echo json_encode(["error" => "Utilisateur non trouvé"]);
       }
    }
    else {
        // Fetch all users
        $stmt = $db->query("SELECT * FROM utilisateur");
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($utilisateurs);
    }
?>
