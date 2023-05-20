<?php
session_start();

try {
    // Connexion à la base de données MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', 'root');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Affichage de l'erreur en cas d'échec de la connexion
    die('Erreur : ' . $e->getMessage());
}

if ($_SESSION["Statut"] === 'Administrateur') {

    $id_a = $_POST["nom"];
    $id_m = $_POST["magasin"];
    $description = $_POST["description"];

    $boutton = $_POST["envoyer"];

    if ($boutton === "Modifier la formule") {
        $ID = $_POST["id"];
        $reponse = $bdd->query('UPDATE _formule SET Description ="' . $description . '", ID_magasin_partenaire="' . $id_m . '",ID_activite="' . $id_a . '" WHERE ID_formule ="' . $ID . '"');
        $donnees = $reponse->fetch();
        header("Location: ../php/espace-admin.php");
    }
    if ($boutton === "Ajouter nouvelle formule") {
        $reponse = $bdd->query('INSERT INTO _formule (ID_magasin_partenaire, ID_activite, Description) VALUES ("' . $id_m . '", "' . $id_a . '","' . $description . '")');
        $donnees = $reponse->fetch();

        header("Location: ../php/espace-admin.php");

    }
    if ($boutton === "Supprimer") {
        $ID = $_POST["id"];
        $reponse = $bdd->query('DELETE FROM _formule WHERE ID_formule ="' . $ID . '"');
        $donnees = $reponse->fetch();

        header("Location: ../php/espace-admin.php");
    }
} else {
    header("Location: ../html/Accueil.html");
}
?>