<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
    <link rel="stylesheet" href="../css/Mon%20compte.css">
    <script src="../js/Mon compte.js"></script>
</head>

<body>
    <header>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <nav>
            <ol>
                <li> <a href="../html/Accueil.html">Accueil</a> </li>
                <li> <a href="../html/OmnesBox.html">Ma OmnesBox</a> </li>
                <li> <a href="../html/carte%20cadeau.html">Carte cadeau</a> </li>
                <li> <a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
            </ol>
        </nav>
        <div id="ligne"></div>

    </header>
    <section>
        <div id="div1">
            <h1> Déjà inscrit ?</h1>
            <form action="../php/Mon compte.php" method="post">
                <label for="mail"> Adresse-mail :</label><br>
                <div class="centrer">
                    <input class="texte" type="email" id="mail" name="mail" required><br>
                </div>
                <label for="mp"> Mot de passe :</label><br>
                <div class="centrer">
                    <input class="texte" type="password" id="mp" name="mp" required><br>
                    <input id="boutton-connexion" class="boutton" type="submit" value="Se connecter">
            </form>
                    <form action="../html/creer-compte.html" method="post">
                        <input name="boutton-creer-compte"class="boutton" type="submit" value="Créer un compte">
                    </form>
                    

                </div>
            
        </div>
    </section>
    <footer>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
    </footer>

</body>

</html>