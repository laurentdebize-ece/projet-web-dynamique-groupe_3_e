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
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) &&  isset($_POST['statut']) && isset($_POST['nom_part']) && isset($_POST['numero_rue']) && isset($_POST['rue']) && isset($_POST['ville']) && isset($_POST['code_postal'])) {
    $nom = $_POST['nom'];
    $nomEnMajuscules = strtoupper($nom);
    $prenom = $_POST['prenom'];
    $prenomEnMajusculePremiereLettre = ucfirst(strtolower($prenom));
    $adresse_mail = $_POST['email'];
    $statut = $_POST['statut'];
    $nom_part = $_POST['nom_part'];
    $nom_partEnMajuscules = strtoupper($nom_part);
    $numero_rue = $_POST['numero_rue'];
    $rue = $_POST['rue'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $description = $_POST['description'];

    // Vérification que les champs obligatoires sont remplis
    if (!empty($nomEnMajuscules) && !empty($prenomEnMajusculePremiereLettre) && !empty($adresse_mail) && !empty($nom_partEnMajuscules) && !empty($numero_rue) && !empty($rue) && !empty($ville) && !empty($code_postal)) {
        //Génére un mot de passe aléatoire
        $mot_de_passe = bin2hex(random_bytes(5));

        // Requête SQL pour insérer les données dans la table utilisateur
        $insertion = "INSERT INTO _utilisateur (Nom, Prenom, Adresse_mail, Mot_de_passe, Statut) VALUES ('$nomEnMajuscules', '$prenomEnMajusculePremiereLettre', '$adresse_mail', '$mot_de_passe', '$statut')";
        $bdd->query($insertion);

        // Récupérer l'ID de l'utilisateur inséré
        $id_utilisateur = $bdd->lastInsertId();


        // Requête SQL pour insérer les données dans la table partenaire
        $insertion = "INSERT INTO _magasin_partenaire (Nom, Ville, Rue, Code_postal, Numero_rue, Description, ID_utilisateur) VALUES ('$nom_partEnMajuscules', '$ville', '$rue', '$code_postal', '$numero_rue', '$description', '$id_utilisateur')";
        $bdd->query($insertion);

        // Envoi d'un mail de confirmation
        $destinataire = "$adresse_mail";
        $sujet = "Confirmation de création de compte";
        $message = "Bonjour $prenomEnMajusculePremiereLettre $nomEnMajuscules, votre compte a bien été créé. Votre mot de passe est : $mot_de_passe";
        $headers = "Content-type: text/plain; charset=utf-8\r\n";
        $headers .= "From: chaperonaxel30@gmail.com" . "\r\n";

        if(mail($destinataire,$sujet,$message,$headers))
            echo "<script>alert(\"Le mail a bien été envoyé.\");</script>";
        else
            echo "Error!";
        

        // Redirection vers la page admin
        sleep(2);
        header("Location: ../php/redirection_connexion.php");
        exit();
    } 
} else {
    echo "<h1>Erreur</h1>";
    echo "<p>Le formulaire n'a pas été soumis.</p>";
}


?>


