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