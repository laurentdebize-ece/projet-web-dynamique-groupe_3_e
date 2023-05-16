<?php
    // Démarrer une nouvelle session
    session_start();   
    // Vérifier si l'utilisateur est connecté
    if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false){
        
        // Rediriger l'utilisateur vers la page de connexion
        header("Location: ../php/Mon%20compte%20non%20connecte.php");
        
    } else {
        // Rediriger l'utilisateur vers la page de son compte
        header("Location: ../php/Mon%20compte%20connecte.php");
        
} 
?>

