<?php
// Démarrer une nouvelle session
session_start();
// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false){

    // Rediriger l'utilisateur vers la page de connexion
    header("Location: ../php/Mon%20compte%20non%20connecte.php");

} else {

    $id_formule = $_POST['id_formule'];
    $prix = $_POST['prix'];

    try {
        // Connexion à la base de données MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
        // Définition du mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        // Affichage de l'erreur en cas d'échec de la connexion
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query('INSERT INTO _carte (Prix, ID_utilisateur, ID_formule, Panier) VALUES ("' . $prix . '", "' . $_SESSION["ID"] . '", "' . $id_formule . '", 1)');

    header("Location: ../html/Accueil.html");

}
?>
