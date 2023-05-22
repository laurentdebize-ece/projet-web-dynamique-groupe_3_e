<?php
session_start();
try {
    // Connexion à la base de données MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
// Affichage de l'erreur en cas d'échec de la connexion
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Omnes BOX</title>
    <link rel="stylesheet" href="../css/OmnesBox.css">
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
    <div id="contenaire-new-carte">
        <img id="image-carte-1" src="../image/carte-cadeau.png" alt="carte cadeau">
        <div class="centrer">
            <div id="contenaire-point-interrogation">
                <p>?</p>
            </div>
            <div id="texte-explicatif">
                <p>texte explicatif</p>
            </div>
        </div>
        <form method="post" id="form-new-carte">

            <label for="numcarte1"></label>
            <input class="texte" type="number" id="numcarte1" name="numcarte1" required>
            <label for="numcarte2"></label>
            <input class="texte" type="number" id="numcarte2" name="numcarte2" required>


            <input class="boutton" type="button" value="&#9205">

        </form>
    </div>
    <div>
        <h2>Mes OmnesBox</h2>
        <h3>Beneficier</h3>
        <?php
        /*$reponse = $bdd->query('SELECT * FROM _carte WHERE ((ID_utilisateur ="' . $_SESSION["ID"] . '" AND ID_utilisateur__beneficie IS NULL) OR ID_utilisateur__beneficie ="' . $_SESSION["ID"] . '") AND Panier = 0 ');*/
        $reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur__beneficie ="' . $_SESSION["ID"] . '" AND Panier = 0 ');
        while ($donnees = $reponse->fetch()) {
            $reponse2 = $bdd->query('SELECT * FROM _formule WHERE ID_formule ="' . $donnees["ID_formule"] . '" ');
            $donnees2 = $reponse2->fetch();
            ?>
            <div class="contenaire-carte">
                <img class="image-carte" src="../image/carte-cadeau.png" alt="carte cadeau">
                <h3 class="titre-carte"><?php echo $donnees2["Description"]; ?></h3>
                <div class="contenaire-prix">
                    <p class="euro">€</p>
                    <p class="prix"><?php echo $donnees["Prix"]; ?></p>
                </div>
                <form>
                    <input type="hidden" name="id-carte" value="<?php echo $donnees["ID_carte"]; ?>">
                    <input type="submit" class="boutton2" value="Utiliser">
                </form>
            </div>
        <?php } ?>
        <h3>Acheter</h3>
        <?php
        /*$reponse = $bdd->query('SELECT * FROM _carte WHERE ((ID_utilisateur ="' . $_SESSION["ID"] . '" AND ID_utilisateur__beneficie IS NULL) OR ID_utilisateur__beneficie ="' . $_SESSION["ID"] . '") AND Panier = 0 ');*/
        $reponse = $bdd->query('SELECT * FROM _carte WHERE (ID_utilisateur ="' . $_SESSION["ID"] . '" AND ID_utilisateur__beneficie IS NULL) AND Panier = 0 ');
        while ($donnees = $reponse->fetch()) {
            $reponse2 = $bdd->query('SELECT * FROM _activite WHERE ID_activite ="' . $donnees["ID_activite"] . '" ');
            $donnees2 = $reponse2->fetch();
            ?>
            <div class="contenaire-carte">
                <img class="image-carte" src="../image/carte-cadeau.png" alt="carte cadeau">
                <h3 class="titre-carte"><?php echo $donnees2["Description"]; ?></h3>
                <h3 class="titre-carte"><?php echo $donnees["Date_achat"]; ?></h3>
                <div class="contenaire-prix">
                    <p class="euro">€</p>
                    <p class="prix"><?php echo $donnees["Prix"]; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>