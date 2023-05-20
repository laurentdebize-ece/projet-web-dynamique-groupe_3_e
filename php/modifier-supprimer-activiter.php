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

if ($_SESSION["Statut"] === 'Administrateur') {


    $nom = $_POST["nom"];
    $prix = $_POST["prix"];
    $description = $_POST["description"];
    $boutton = $_POST["envoyer"];

    if ($boutton === "Modifier la carte") {
        $ID = $_POST["id"];
        $reponse = $bdd->query('UPDATE _activite SET Nom ="' . $nom . '", Prix="' . $prix . '",Description="' . $description . '" WHERE ID_activite ="' . $ID . '"');
        $donnees = $reponse->fetch();
        header("Location: ../php/espace-admin.php");
    }
    if ($boutton === "Ajouter nouvelles cartes") {
        $reponse = $bdd->query('INSERT INTO _activite (Nom, Prix, Description) VALUES ("' . $nom . '", "' . $prix . '","' . $description . '")');
        $donnees = $reponse->fetch();

        header("Location: ../php/espace-admin.php");

    }
    if ($boutton === "Supprimer") {
        $ID = $_POST["id"];
        $reponse = $bdd->query('DELETE FROM _formule WHERE ID_activite ="' . $ID . '"');
        $donnees = $reponse->fetch();

        $reponse = $bdd->query('DELETE FROM _activite WHERE ID_activite ="' . $ID . '"');
        $donnees = $reponse->fetch();
        header("Location: ../php/espace-admin.php");


    }
} else {
    header("Location: ../html/Accueil.html");
}
?>