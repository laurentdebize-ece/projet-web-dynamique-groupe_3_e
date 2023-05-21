<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/creer-compte.css">
    <script src="../js/Accueil.js"></script>
</head>
<body>
<header>
    <a href="../html/Accueil.html" ><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li> <a href="../html/Accueil.html">Accueil</a> </li>
            <li> <a href="OmnesBox.php">Ma OmnesBox</a> </li>
            <li> <a href="../html/carte-cadeau.html">Carte cadeau</a> </li>
            <li> <a href="Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a href="redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>
<section>
    <div id="div1">
        <h1> Créer mon compte</h1>
        <form method="post" name="form" action="creer%20compte.php">
            <label for="nom" id="surname"> Nom : </label><br>
            <div class="centrer"><input class="texte" type="text" name="nom" id="nom" style="text-transform: uppercase;" required><br></div>

            <label for="prenom" id="name"> Prénom : </label><br>
            <div class="centrer"><input class="texte" type="text" name="prenom" id="prenom" style="text-transform: capitalize;" required><br></div>

<?php
$boutton = $_POST["boutton-creer-compte"];
if ($boutton === "+"){
    $statut = "Partenaire";
}
else{
    $statut = "Client";
}
?>
            <div class="centrer"><input class="texte" type="text" name="statut" id="statut2" value="<?php echo $statut; ?>" style="display: none"></div>

            <label for="email" id="mail">Adresse mail : </label><br>
            <div class="centrer"><input class="texte" type="email" name="email" id="email" required><br></div>

            <label for="password" id="mdp">Mot de passe : </label><br>
            <div class="centrer"><input class="texte" type="password" name="password" id="password" required><br></div>

            <div class="centrer"><input class="boutton" type="submit" name="envoyer" value="Créer mon compte"></div>
        </form>
    </div>
</section>
<footer>
    <a href="../html/Accueil.html" ><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>

</body>
</html>
