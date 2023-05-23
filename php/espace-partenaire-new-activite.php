<?php
session_start();

$id = $_POST["id"];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/espace-admin-partenaire.css">
    <script src="../js/Accueil.js"></script>
</head>
<body>
<header>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li><a href="../html/Accueil.html">Accueil</a></li>
            <li><a href="OmnesBox.php">Ma OmnesBox</a></li>
            <li><a href="../html/carte-cadeau.html">Carte cadeau</a></li>
            <li><a href="Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a
                    href="redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>
<section>
    <div id="div1">
        <h1>Proposer une activité</h1>
        <form method="post" name="form" action="ajouter_activite.php">
            <label for="nom" id="surname"> Nom : </label><br>
            <div class="centrer"><input class="texte" type="text" name="nom" id="nom"><br>
            </div>

            <label for="prix"> Prix : </label><br>
            <div class="centrer"><input class="texte" type="number" name="prix" id="prix"><br></div>

            <label for="description">Description : </label><br>
            <div class="centrer"><input class="texte" type="text" name="description"><br></div>

            <div class="centrer"><input class="boutton" type="submit" name="envoyer" value="Soumettre">
            </div>
        </form>
    </div>
</section>
<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>

</body>
</html>