<?php
// Vérification si le paramètre 'id' est présent dans l'URL
if (isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];
} else {
    // Paramètre manquant, gestion de l'erreur
    echo "ID de l'utilisateur non spécifié";
}
?>
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
        <h1> Modification mot de passe</h1>
        <form method="post" name="form" action="Modification%20mdp%20partenaire%20traitement.php">

            <input type="hidden" name="id" value="<?php echo $id_utilisateur; ?>">

            <label for="mdp" id="mdp"> Saisir un mot de passe : </label><br>
            <div class="centrer"><input class="texte" type="password" name="mdp" id="mdp" required><br></div>

            <label for="confirm_mdp" id="confirm_mdp"> Confirmer le mot de passe : </label><br>
            <div class="centrer"><input class="texte" type="password" name="confirm_mdp" id="confirm_mdp" required><br></div>

            <div class="centrer"><input class="boutton" type="submit" name="envoyer" value="Modifer"></div>

        </form>
    </div>
</section>
<footer>
    <a href="../html/Accueil.html" ><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>

</body>
</html>
