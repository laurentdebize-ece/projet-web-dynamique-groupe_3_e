<?php
session_start();
if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false) {
    // Rediriger l'utilisateur vers la page de connexion
    header("Location: ../php/Mon%20compte%20non%20connecte.php");
    exit();
} else {
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
}

$reponse5 = $bdd->query('SELECT * FROM _carte WHERE ID_carte = "' . $_POST['id-carte'] . '"');
$donnees5 = $reponse5->fetch();

$reponse2 = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_magasin_partenaire = "' . $_POST['id-m'] . '"');
$donnees2 = $reponse2->fetch();

$reponse3 = $bdd->query("UPDATE _magasin_partenaire SET Somme_gagner = '". $donnees2['Somme_gagner'] + $donnees5['Prix'] ."' WHERE ID_magasin_partenaire ='" . $_POST['id-m'] . "'");
$donnees3 = $reponse3->fetch();
$reponse = $bdd->query('DELETE FROM _carte WHERE ID_carte = "' . $_POST['id-carte'] . '"');
$donnees = $reponse->fetch();
?>
<script>
    function showMessage() {
        alert("Votre carte cadeau a été utilisée avec succès !");
        setTimeout(function() {
            window.location.href = "../html/Accueil.html";
        }, 5000);
    }
    showMessage();
</script>
<?php
header("Location: ../php/OmnesBox.php");
?>
