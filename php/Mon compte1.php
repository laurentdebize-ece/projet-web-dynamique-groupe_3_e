<?php    
    // Démarrer la session
    session_start();
    // Vérifier si l'utilisateur est connecté
    if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false){
        
        echo '
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
                    <li> <a href="../html/carte-cadeau.html">Carte cadeau</a> </li>
                    <li> <a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a href="../php/Mon%20compte1.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
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
                        <input class="boutton" type="button" value="Créer un compte">
                    </div>
                </form>
            </div>
        </section>
        ';
    } else {
        echo '
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Mon compte</title>
            <link rel="stylesheet" href="../css/Mon%20compte2.css">
            <script src="../js/Mon compte.js"></script>
        </head>
        <body>
        <header>
            <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
            <nav>
                <ol>
                    <li> <a href="../html/Accueil.html">Accueil</a> </li>
                    <li> <a href="../html/OmnesBox.html">Ma OmnesBox</a> </li>
                    <li> <a href="../html/carte-cadeau.html">Carte cadeau</a> </li>
                    <li> <a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a href="../php/Mon%20compte1.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
                </ol>
            </nav>
        <div id="ligne"></div>

        </header>
        <section>
        <div id="div1">
            <div class="centrer"> <img src="../image/compte2.png" alt="icone-compte"></div>
            <h1>'. $_SESSION["Nom"] . '  ' . $_SESSION["Prenom"] . '</h1>
            <div class="mail-mp"><p class="intituler" >Adresse-mail :  </p><p class="donner" > ' . $_SESSION["Adresse_mail"] . '</p></div>
            <div class="mail-mp"><p class="intituler" >Mot de passe :  </p><p class="donner"> '  . $_SESSION["Mot_de_passe"] . '</p></div>
            <div class="mail-mp"><p class="intituler" >Statut :  </p><p class="donner"> ' . $_SESSION["Statut"] . '</p></div>
        </div>
        <form action="" method="post">
            <input name="boutton-deconnexion" class="boutton" type="submit" value="Se déconnecter">
        </form>
        </section>
        ';
        if(isset($_POST['boutton-deconnexion'])){
            session_destroy();
            header("Location: ../html/Accueil.html");
        }
    }
     
    ?>

<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>

</body>
</html>