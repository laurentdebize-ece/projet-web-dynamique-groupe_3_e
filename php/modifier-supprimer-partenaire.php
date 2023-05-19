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
