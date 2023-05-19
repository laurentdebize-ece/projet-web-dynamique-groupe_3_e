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
                <li> <a href="../html/carte_cadeau.html">Carte cadeau</a> </li>
                <li> <a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
            </ol>
        </nav>
        <div id="ligne"></div>

    </header>
    <section>
        <?php session_start(); ?>
        <div id="div1">
            <div class="centrer"> <img src="../image/compte2.png" alt="icone-compte"></div>
            <h1> <?php echo($_SESSION["Nom"]);?>  <?php echo($_SESSION["Prenom"]);?></h1>
            <div class="mail-mp">
                <p class="intituler">Adresse-mail : </p>
                <p class="donner">   <?php echo($_SESSION["Adresse_mail"]); ?></p>
            </div>
            <div class="mail-mp">
                <p class="intituler">Mot de passe : </p>
                <p class="donner">   <?php echo($_SESSION["Mot_de_passe"]); ?></p>
            </div>
            <div class="mail-mp">
                <p class="intituler">Statut : </p>
                <p class="donner">   <?php echo($_SESSION["Statut"]); ?></p>
            </div>
        </div>
        <div class="centrer">
        <form action="" method="post">
            <input name="boutton-deconnexion" id="boutton-connexion" class="boutton" type="submit" value="Se déconnecter">
        </form>
        </div>
        <?php
        if(isset($_POST["boutton-deconnexion"])){
            session_destroy();
            header("Location: ../html/Accueil.html");
            $_SESSION["connecte"]=false;
        }
        ?>
    </section>

    <footer>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
    </footer>

</body>

</html>