<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/formule.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="../js/formule.js"></script>
</head>
<body>
<header>
    <a href="../html/Accueil.html"><img id="logo" src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li id="accueil"><a href="../html/Accueil.html">Accueil</a></li>
            <li id="omnesbox"><a href="OmnesBox.php">Ma OmnesBox</a></li>
            <li id="carte-cadeau"><a href="../php/carte_cadeau.php">Carte cadeau</a></li>
            <li id="icone"><a href="Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a
                        href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a>
                <div id="menu">
                    <div class="petite-ligne" id="petite-ligne-1"></div>
                    <div class="petite-ligne" id="petite-ligne-2"></div>
                </div>
            </li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>

<body>

<?php
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


// Récupération de l'ID de l'activité sélectionnée
if (isset($_POST['activite_id'])) {

    $idActivite = $_POST['activite_id'];
    // Requête pour récupérer les formules selon l'ID de l'activité
    $reponse = $bdd->query('SELECT * FROM _activite LEFT JOIN _formule ON _activite.ID_activite = _formule.ID_activite WHERE _activite.ID_activite ="' . $idActivite . '"');
    ?>
    <table>
        <tr>
            <th>description</th>
        </tr>
        <?php
        while ($donnees = $reponse->fetch()) {
            $description = $donnees["Description"];

            ?>
            <tr>
                <td><?php echo $description ;?></td>
                <td>
                    <form action="../php/ajout-carte.php" method="post" id="ajout-panier-form">
                        <input type="hidden" name="id_formule" value="<?php echo $donnees["ID_formule"] ;?>">
                        <input type="hidden" name="prix" value="<?php echo $donnees["Prix"] ;?>">
                        <input name="ajout-panier" id="ajout-panier" class="boutton" type="submit"
                               value="Ajouter au panier">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?></table> <?php

}



?>
</body>


<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>
