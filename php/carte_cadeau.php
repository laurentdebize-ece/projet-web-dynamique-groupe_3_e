<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>carte cadeau</title>
    <link rel="stylesheet" href="../css/cartecadeau.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/cartecadeau.js"></script>
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
                        href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a>
            </li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>

<?php
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

<section>
    <div id="contenaire-all-carte">
        <div class="row">
            <?php

            // Requête pour récupérer les activités
            $reponse = $bdd->query('SELECT DISTINCT Nom FROM _activite ORDER BY Nom');

            while ($row = $reponse->fetch()) {
                $nom = $row['Nom'];
                ?>
                <div class="col-sm-4">
                    <div class="contenaire-carte">
                        <img class="image" src="../image/carte-cadeau.png" alt="carte cadeau">
                        <div class="contenaire-all-prix">
                            <?php
                            $reponse2 = $bdd->query('SELECT * FROM _activite WHERE Nom ="' . $nom . '"ORDER BY Prix');
                            while ($row2 = $reponse2->fetch()) {
                                $activite_id = $row2["ID_activite"];
                                $montant = $row2["Prix"];
                                ?>


                                <form action="../php/formule.php" method="post">
                                    <input type="hidden" name="activite_id" value="<?php echo $activite_id; ?>">
                                    <input class="boutton" type="submit" value="€ <?php echo $montant; ?>">
                                </form>

                            <?php } ?>
                        </div>
                    </div>
                    <h3 class="titre"><?php echo $nom; ?></h3>
                </div>

            <?php } ?>
        </div>
    </div>
</section>


<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>

