<?php
session_start();

try {
    // Tentative de connexion à la base de données MySQL (MAMP)
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    try {
        // Tentative de connexion à la base de données MySQL (WAMP)
        $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', 'root');
        // Définition du mode d'erreur de PDO sur Exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Gestion de l'erreur de connexion
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit();
    }
}

if ($_SESSION["Statut"] === 'Administrateur') {

    $id = $_POST["id"];
    $boutton = $_POST["bouton-acter"];

    if ($boutton === "oui") {
        $reponse = $bdd->query('UPDATE _formule SET Acter = 1 WHERE ID_formule ="' . $id . '"');
        $donnees = $reponse->fetch();
    }
    if ($boutton === "non") {
        $reponse = $bdd->query('DELETE FROM _formule WHERE ID_formule ="' . $id . '"');
        $donnees = $reponse->fetch();

    }
    header("Location: ../php/espace-admin.php");

} else {
    header("Location: ../html/Accueil.html");
}
?>