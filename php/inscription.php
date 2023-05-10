<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=myomnesbox;charset=utf8',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $motdepasse = $_POST["pwd"];
    

    // Préparation et exécution de la requête SQL
    $bdd->query("SET FOREIGN_KEY_CHECKS=0");
    $bdd->query("INSERT INTO _utilisateur (Nom, Prenom, Adresse_mail, Mot_de_passe, Statut) VALUES ('$nom', '$prenom', '$email', '$motdepasse', 'client')");
    $bdd->query("SET FOREIGN_KEY_CHECKS=1");
    if ($bdd->query("SELECT LAST_INSERT_ID()") !== FALSE) {
        echo "Utilisateur ajouté avec succès";
    } else {
        echo "Erreur : " ;
    }

    // Fermeture de la connexion à la base de données
    $bdd = null;
    ?>





</body>

</html>