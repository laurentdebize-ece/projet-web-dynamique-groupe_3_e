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
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>achat</title>
    <link rel="stylesheet" href="../css/achat.css">
    <script src="../js/achat.js"></script>
</head>
<body>
<header>
    <a href="Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li><a href="Accueil.html">Accueil</a></li>
            <li><a href="../php/OmnesBox.php">Ma OmnesBox</a></li>
            <li><a href="../php/carte_cadeau.php">Carte cadeau</a></li>
            <li><a href="../php/Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a
                    href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>
<section>
    <div id="div1">
        <form method="post" name="form" action="../php/achat.php" >

            <label for="numcarte" id="numeroCarte"> N° de carte</label><br>
            <input  type="number" name="numcarte" id="numcarte" placeholder="XXXX XXXX XXXX XXXX"  required><br>

            <div id="flex">
                <div>
                    <label for="dExpiration" id="dateExpiration">Date d'expiration</label><br>
                    <input class="input" type="month"   name="dExpiration" id="dExpiration" required>
                </div>
                <div>
                    <label for="crypto" id="cryptogramme">Cryptogramme</label><br>
                    <input class="input" type="number" placeholder="XXX" name="crypto" id="crypto" max="999" required>
                </div>
                <div>
                    <?php
                    $reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur ="' . $_SESSION["ID"] . '" AND Panier = 1 ');

                    while ($donnees = $reponse->fetch()) {

                        ?>
                        <input type="hidden" id="<?php echo $donnees["ID_carte"]; ?>" name="<?php echo $donnees["ID_carte"]; ?>" value="<?php echo $_POST[''.$donnees["ID_carte"].'']; ?>">
                    <?php } ?>
                    <input class="boutton" type="submit" name="envoyer" value="Commander">
                </div>
            </div>


        </form>
    </div>

</section>
<footer>
    <a href="Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>
