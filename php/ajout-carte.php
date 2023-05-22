<?php
// Démarrer une nouvelle session
session_start();
// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false){

    // Rediriger l'utilisateur vers la page de connexion
    header("Location: ../php/Mon%20compte%20non%20connecte.php");

} else {

    $id_activite = $_POST['id_activite'];
    $prix = $_POST['prix'];

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
    $reponse = $bdd->query('INSERT INTO _carte (Prix, ID_utilisateur, ID_activite, Panier) VALUES ("' . $prix . '", "' . $_SESSION["ID"] . '", "' . $id_activite . '", 1)');

    header("Location: ../html/Accueil.html");

}
?>
