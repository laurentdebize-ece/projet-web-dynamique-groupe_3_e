<?php
    if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix'])){
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
    }

    //Connexion BDD

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

    $insertion = "INSERT INTO _activite(Nom, Prix, Description) VALUES ('$nom','$prix','$description')";
    $bdd->query($insertion);
?>

    