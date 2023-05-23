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
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Omnes BOX</title>
    <link rel="stylesheet" href="../css/OmnesBox.css">
    <link rel="stylesheet" href="../css/carte_utilise.css">
    <script src="../js/OmnesBox.js"></script>
</head>
<body>
<header>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li><a href="../html/Accueil.html">Accueil</a></li>
            <li><a href="OmnesBox.php">Ma OmnesBox</a></li>
            <li><a href="../php/carte_cadeau.php">Carte cadeau</a></li>
            <li><a href="Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a
                        href="redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>
<section>
    <div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ID_carte = $_POST['id-carte'];

            $requeteCarte = $bdd->prepare('SELECT * FROM _carte WHERE ID_carte = "' . $_POST["id-carte"] . '" ');
            $requeteCarte->execute();
            $donnees = $requeteCarte->fetch();

            $reponse2 = $bdd->query('SELECT * FROM _formule WHERE ID_formule ="' . $donnees["ID_formule"] . '" AND Acter = 1 ');
            $donnees2 = $reponse2->fetch();

            $partenaires = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_magasin_partenaire ="' . $donnees2["ID_magasin_partenaire"] . '" ');
            $partenaires->execute();
            $donnees3 = $partenaires->fetch();

            $supprimerCarte = $bdd->prepare('DELETE FROM _carte WHERE ID_carte = :id_carte');
            $supprimerCarte->bindParam(':id_carte', $_POST["id-carte"]);
            $supprimerCarte->execute();
            ?>
            <div class="contenaire-carte">
                <img class="image-carte" src="../image/carte-cadeau.png" alt="carte cadeau">
                <h3 class="titre-carte"><?php echo $donnees2["Description"]; ?></h3>
                <div class="contenaire-prix">
                    <p class="euro">€</p>
                    <p class="prix"><?php echo $donnees["Prix"]; ?></p>
                </div>
                <div class="formule-carte">
                    <img src="../image/zara.png" alt="logo zara" class="logo-zara">
                    <p class="formule"><?php echo $donnees3["Nom"]; ?></p>
                    
                </div>
                <div>
                <form action="../html/Accueil.html" method="post" onsubmit="showMessage()">
                    <input type="hidden" name="id-carte" value="<?php echo $donnees["ID_carte"]; ?>">
                    <input type="submit" class="boutton2" value="Utiliser">
                </form>
                <script>
                    function showMessage() {
                        alert("Votre carte cadeau a été utilisée avec succès !");
                        setTimeout(function() {
                            window.location.href = "../html/Accueil.html";
                        }, 5000);
                    }
                </script>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
    </section>
<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>
