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
        $reponse = $bdd->query('INSERT INTO _formule (ID_magasin_partenaire, ID_activite, Description,Acter) VALUES ("' . $id_m . '", "' . $id_a . '","' . $description . '","1")');
        $donnees = $reponse->fetch();

        header("Location: ../php/espace-admin.php");

    }
    if ($boutton === "Supprimer") {
        $ID = $_POST["id"];
        $reponse = $bdd->query('DELETE FROM _formule WHERE ID_formule ="' . $ID . '"');
        $donnees = $reponse->fetch();

        header("Location: ../php/espace-admin.php");
    }
} else if ($_SESSION["Statut"] === 'Partenaire') {

    $id_a = $_POST["nom"];
    $id_m = $_POST["magasin"];
    $description = $_POST["description"];

    $reponse = $bdd->query('INSERT INTO _formule (ID_magasin_partenaire, ID_activite, Description, Acter) VALUES ("' . $id_m . '", "' . $id_a . '","' . $description . '", "0")');
    $donnees = $reponse->fetch();

    header("Location: ../php/espace-partenaire.php");


} else {
    header("Location: ../html/Accueil.html");
}
?>