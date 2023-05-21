<?php
session_start();
try {
    // Connexion à la base de données MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Affichage de l'erreur en cas d'échec de la connexion
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('UPDATE _carte SET Panier = 0 WHERE ID_utilisateur ="' . $_SESSION["ID"] . '" AND Panier = 1 ');

header("Location: ../html/Accueil.html");
?>