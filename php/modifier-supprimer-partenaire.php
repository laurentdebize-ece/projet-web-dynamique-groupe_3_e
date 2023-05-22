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
    $ID = $_POST["id"];
    $nom = $_POST["nom"];
    $mail = $_POST["mail"];
    $Nrue = $_POST["Nrue"];
    $rue = $_POST["rue"];
    $CP = $_POST["CP"];
    $ville = $_POST["ville"];
    $description = $_POST["description"];
    $boutton = $_POST["envoyer"];

    if ($boutton === "Modifier") {
        $reponse = $bdd->query('UPDATE _utilisateur SET Nom ="' . $nom . '", Prenom="' . $nom . '",Adresse_mail="' . $mail . '" WHERE ID_utilisateur ="' . $ID . '"');
        $donnees = $reponse->fetch();
        $reponse = $bdd->query('UPDATE _magasin_partenaire SET Nom ="' . $nom . '", Ville="' . $ville . '",Rue="' . $rue . '" ,Code_postal="' . $CP . '" ,Numero_rue="' . $Nrue . '" ,Description="' . $description . '"  WHERE ID_utilisateur ="' . $ID . '"');
        $donnees = $reponse->fetch();
        header("Location: ../php/espace-admin.php");

    }
    if ($boutton === "Supprimer") {
        $reponse = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_utilisateur ="' . $ID . '"');
        $donnees = $reponse->fetch();
        $id_user = $donnees['ID_magasin_partenaire'];

        $reponse = $bdd->query('DELETE FROM _formule WHERE ID_magasin_partenaire ="' . $id_user . '"');
        $donnees = $reponse->fetch();

        $reponse = $bdd->query('DELETE FROM _magasin_partenaire WHERE ID_utilisateur ="' . $ID . '"');
        $donnees = $reponse->fetch();

        $reponse = $bdd->query('DELETE FROM _utilisateur WHERE ID_utilisateur ="' . $ID . '"');
        $donnees = $reponse->fetch();
        header("Location: ../html/Accueil.html");


    }
} else {
    header("Location: ../html/Accueil.html");
}
?>
