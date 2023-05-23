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

if ($_SESSION["Statut"] === 'Partenaire') {
    $ID = $_SESSION["ID"];
    $reponse = $bdd->query('SELECT ID_magasin_partenaire FROM _magasin_partenaire WHERE ID_utilisateur="' . $ID . '"');
    $donnees = $reponse->fetch();
    $ID_m = $donnees['ID_magasin_partenaire'];
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Omnes BOX</title>
        <link rel="stylesheet" href="../css/espace-partenaire.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="../js/espace-admin.js"></script>

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
                            href="redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
            </ol>
        </nav>
        <div id="ligne"></div>

    </header>
    <section>
        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Client </h2>
                <p>&#9207</p>
            </div>
            <div class="contenu">
                <table>
                    <thead>
                    <tr>
                        <th>Produits</th>
                        <th>Montant</th>
                    </tr>
                    </thead>
                    <?php
                    $reponse2 = $bdd->query('SELECT * FROM _carte WHERE NOT ID_utilisateur__beneficie IS NULL AND Panier = 0 ');

                    while ($donnees2 = $reponse2->fetch()) {
                        if ($donnees2["ID_formule"] != null) {
                            $reponse3 = $bdd->query('SELECT * FROM _formule WHERE ID_formule="' . $donnees2["ID_formule"] . '"');
                            $donnees3 = $reponse3->fetch();
                            $id_m2 = $donnees3["ID_magasin_partenaire"];
                            if ($ID_m === $id_m2) {
                                ?>
                                <tbody>
                                <tr class="produit">
                                    <td><img class="image" src="../image/carte-cadeau.png">

                                        <p><?php $reponse4 = $bdd->query('SELECT * FROM _activite WHERE ID_activite="' . $donnees3["ID_activite"] . '"');
                                            $donnees4 = $reponse4->fetch();
                                            echo $donnees4["Nom"]; ?><br><br>
                                            <?php echo $donnees3["Description"]; ?></p></td>
                                    <td class="prix"><?php echo $donnees2["Prix"]; ?> €</td>
                                </tr>
                                </tbody>
                                <?php
                            }
                        }
                    }
                    ?></table>
            </div>
        </div>
        <div class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Vos Activités</h2>
                <p>&#9207</p>
            </div>
            <div class="contenu">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>description</th>
                    </tr>
                    <?php
                    $reponse = $bdd->query('SELECT DISTINCT ID_activite FROM _formule WHERE ID_magasin_partenaire="' . $ID_m . '"');
                    while ($donnees = $reponse->fetch()) {
                        $id = $donnees['ID_activite'];
                        $reponse2 = $bdd->query('SELECT * FROM _activite WHERE ID_activite="' . $id . '"');
                        $donnees2 = $reponse2->fetch();

                        $nom = $donnees2['Nom'];
                        $prix = $donnees2['Prix'];
                        $description = $donnees2['Description'];

                        ?>
                        <tr>
                            <td><?php echo $nom; ?></td>
                            <td><?php echo $prix; ?></td>
                            <td><?php echo $description; ?></td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td colspan="3" class="td-modifier">
                            <form action="../php/espace-partenaire-new-activite.php" method="post">
                                <select id="nom" name="nom" class="texte">
                                    <?php
                                    $reponse = $bdd->query('SELECT _activite.ID_activite FROM _activite
LEFT JOIN _formule on _activite.ID_activite = _formule.ID_activite
LEFT JOIN _magasin_partenaire ON _magasin_partenaire.ID_magasin_partenaire = _formule.ID_magasin_partenaire
WHERE NOT _formule.ID_magasin_partenaire = "' . $ID_m . '" OR _formule.ID_magasin_partenaire is null');
                                    while ($donnees = $reponse->fetch()) {
                                        $id = $donnees['ID_activite'];
                                        $reponse4 = $bdd->query('SELECT * FROM _activite WHERE ID_activite="' . $id . '"');
                                        $donnees4 = $reponse4->fetch(); ?>

                                        <!--<option
                                                value="<?php //echo $donnees4['ID_activite']; ?>"><?php //echo $donnees4['Nom']; ?>
                                            -<?php //echo $donnees4['Prix']; ?>
                                        </option>-->
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="id" value="<?php echo $ID_m; ?>">
                                <!--<input class="modifier" type="submit" value="+">-->
                            </form>
                        </td>

                    </tr>
                </table>


            </div>

        </div>

        <div class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Vos Formules</h2>
                <p>&#9207</p>
            </div>
            <div class="contenu">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>description</th>
                    </tr>
                    <?php
                    $reponse = $bdd->query("SELECT * FROM _formule WHERE Acter = 1");

                    while ($donnees = $reponse->fetch()) {

                        $description = $donnees['Description'];
                        $id = $donnees['ID_formule'];

                        $id_m = $donnees['ID_magasin_partenaire'];
                        $id_A = $donnees['ID_activite'];
                        if ($id_m === $ID_m) {

                            $reponse2 = $bdd->query('SELECT * FROM _activite WHERE ID_activite ="' . $id_A . '"');

                            $donnees2 = $reponse2->fetch();
                            $nom = $donnees2['Nom'];
                            $prix = $donnees2['Prix'];

                            $reponse3 = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_magasin_partenaire ="' . $id_m . '"');
                            $donnees3 = $reponse3->fetch();

                            ?>
                            <tr>
                                <td><?php echo $nom; ?></td>
                                <td><?php echo $prix; ?></td>
                                <td><?php echo $description; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="td-modifier">
                            <form action="../php/espace-admin-new-formule.php" method="post">
                                <input type="text" name="id" value="-1" style="display: none">
                                <input class="modifier" type="submit" value="+">
                            </form>
                        </td>

                    </tr>
                </table>


            </div>

        </div>


    </section>
    <footer>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
    </footer>
    </body>
    </html>
<?php } else {
    header("Location: ../html/Accueil.html");
} ?>