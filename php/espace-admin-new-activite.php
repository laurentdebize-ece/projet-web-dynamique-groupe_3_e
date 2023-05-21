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
$ID_activite =$_POST["nom"];
/*$Nom
$Prix
$Description*/

$reponse = $bdd->query('INSERT INTO _activite (ID_activite, Nom, Prix, Description) VALUES (20, le quellec, 10, teste)');
$donnees = $reponse->fetch();

header("Location: ../php/espace-partenaire.php");

?>