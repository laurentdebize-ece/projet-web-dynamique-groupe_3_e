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
    $texte = "Ajouter nouvelle formule";
    $nom = null;
    $prix = null;
    $magasin = null;
    $description = null;
} else {
    $texte = "Modifier la formule";
    $reponse = $bdd->query("SELECT * FROM _formule WHERE ID_formule = $id");
    $donnees = $reponse->fetch();

    $description = $donnees['Description'];
    $id = $donnees['ID_formule'];
    $id_m = $donnees['ID_magasin_partenaire'];
    $id_A = $donnees['ID_activite'];

    $reponse2 = $bdd->query('SELECT * FROM _activite WHERE ID_activite ="' . $id_A . '"');
    $donnees2 = $reponse2->fetch();

    $nom = $donnees2['Nom'];
    $prix = $donnees2['Prix'];

    $reponse3 = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_magasin_partenaire ="' . $id_m . '"');
    $donnees3 = $reponse3->fetch();

    $magasin = $donnees3['Nom'];
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
        <form method="post" name="form" action="modifier-supprimer-formule.php">

            <input type="hidden" name="id"
                   value="<?php echo $id; ?>">

            <label for="nom" id="surname"> Activité-prix : </label><br>
            <div class="centrer">
                <select id="nom" name="nom" class="texte">
                    <?php
                    $reponse4 = $bdd->query('SELECT DISTINCT Nom FROM _activite');
                    while ($donnees4 = $reponse4->fetch()) { ?>
                        <optgroup label="<?php echo $donnees4['Nom']; ?>">
                            <?php
                            $reponse5 = $bdd->query('SELECT * FROM _activite WHERE Nom ="' . $donnees4['Nom'] . '"');
                            while ($donnees5 = $reponse5->fetch()) { ?>
                                <option
                                    <?php if ($donnees4['Nom'] === $nom && $donnees5['Prix'] === $prix) { ?>
                                        selected="selected"
                                    <?php } ?>
                                        value="<?php echo $donnees5['ID_activite']; ?>"><?php echo $donnees5['Nom']; ?>
                                    -<?php echo $donnees5['Prix']; ?>
                                </option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
                </select>
            </div>


            <label for="magasin"> magasin : </label><br>
            <div class="centrer">
                <select id="nom" name="magasin" class="texte">
                    <?php
                    $reponse6 = $bdd->query('SELECT * FROM _magasin_partenaire');
                    while ($donnees6 = $reponse6->fetch()) { ?>
                        <option
                            <?php if ($donnees6['Nom'] === $magasin) { ?>
                                selected="selected"
                            <?php } ?>
                                value="<?php echo $donnees6['ID_magasin_partenaire']; ?>"><?php echo $donnees6['Nom']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

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