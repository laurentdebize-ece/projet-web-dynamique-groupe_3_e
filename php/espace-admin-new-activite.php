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
}

$id = $_POST["id"];

if ($id === "-1") {
    $texte = "Ajouter nouvelles cartes";
    $nom = null;
    $prix = null;
    $description = null;
} else {
    $texte = "Modifier la carte";
    $reponse = $bdd->query("SELECT * FROM _activite WHERE ID_activite = $id");
    $donnees = $reponse->fetch();
    $nom = $donnees['Nom'];
    $prix = $donnees['Prix'];
    $description = $donnees['Description'];
}
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
        <h1><?php echo $texte; ?></h1>
        <form method="post" name="form" action="modifier-supprimer-activiter.php">
            <label for="nom" id="surname"> Nom : </label><br>
            <div class="centrer"><input class="texte" type="text" name="nom" id="nom" value="<?php echo $nom; ?>"><br>
            </div>

            <label for="prix"> Prix : </label><br>
            <div class="centrer"><input class="texte" type="number" name="prix" id="prix"
                                        value="<?php echo $prix; ?>"><br></div>

            <label for="description">Description : </label><br>
            <div class="centrer"><input class="texte" type="text" name="description"
                                        value="<?php echo $description; ?>"><br></div>

            <div class="centrer"><input class="boutton" type="submit" name="envoyer" value="<?php echo $texte; ?>">
                <?php
                if ($id != -1) { ?>
                    <input class="boutton-supprimer" type="submit" name="envoyer" value="Supprimer">
                    <input class="texte" type="text" name="id" value="<?php echo $id; ?>"
                           style="display: none">


                <?php } ?>
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