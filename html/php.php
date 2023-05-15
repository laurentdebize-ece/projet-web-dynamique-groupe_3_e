<?php

try {
    // Connexion à la base de données MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', 'root');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Affichage de l'erreur en cas d'échec de la connexion
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['statut'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse_mail = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $statut = $_POST['statut'];

    // Vérification que les champs obligatoires sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($adresse_mail) && !empty($mot_de_passe)) {
        // Requête SQL pour insérer les données dans la table utilisateur
        $insertion = "INSERT INTO utilisateur (Nom, Prenom, Adresse_mail, Mot_de_passe, Statut, Panier) VALUES ('$nom', '$prenom', '$adresse_mail', '$mot_de_passe', '$statut',0)";
        $bdd->query($insertion);

        // Récupérer l'ID de l'utilisateur inséré
        $id_utilisateur = $bdd->lastInsertId();

        // Mettre à jour la colonne "panier" avec l'ID de l'utilisateur inséré
        $update = "UPDATE utilisateur SET panier = $id_utilisateur WHERE ID_utilisateur = $id_utilisateur";
        $bdd->query($update);

        // Affichage d'un message de confirmation
        echo "<h1>Résultats</h1>";
        echo "<p>Le compte a été créé avec succès !</p>";
    } else {
        echo "<h1>Erreur</h1>";
        echo "<p>Tous les champs sont obligatoires.</p>";
    }
} else {
    echo "<h1>Erreur</h1>";
    echo "<p>Le formulaire n'a pas été soumis.</p>";
}


?>


