<?php

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


// Récupération des données du formulaire
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['statut'])) {
    $nom = $_POST['nom'];
    $nomEnMajuscules = strtoupper($nom);
    $prenom = $_POST['prenom'];
    $prenomEnMajusculePremiereLettre = ucfirst(strtolower($prenom));
    $adresse_mail = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $statut = $_POST['statut'];

    // Vérification que les champs obligatoires sont remplis
    if (!empty($nomEnMajuscules) && !empty($prenomEnMajusculePremiereLettre) && !empty($adresse_mail) && !empty($mot_de_passe)) {
        // Requête SQL pour insérer les données dans la table utilisateur
        $insertion = "INSERT INTO _utilisateur (Nom, Prenom, Adresse_mail, Mot_de_passe, Statut) VALUES ('$nomEnMajuscules', '$prenomEnMajusculePremiereLettre', '$adresse_mail', '$mot_de_passe', '$statut')";
        $bdd->query($insertion);

        // Récupérer l'ID de l'utilisateur inséré
        $id_utilisateur = $bdd->lastInsertId();

        // Redirection vers la page de connexion
        header("Location: ../php/Mon%20compte%20non%20connecte.php");
    } else {
        header("Location: ../html/formulaire creer compte.php");
    }
} else {
    echo "<h1>Erreur</h1>";
    echo "<p>Le formulaire n'a pas été soumis.</p>";
}


?>


