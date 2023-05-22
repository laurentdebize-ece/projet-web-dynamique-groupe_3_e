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

if ($_SESSION["Statut"] === 'Administrateur') {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Omnes BOX</title>
        <link rel="stylesheet" href="../css/espace-admin.css">
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
                <li><a href="../html/carte-cadeau.html">Carte cadeau</a></li>
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
                <?php
                $reponse = $bdd->query("SELECT * FROM _utilisateur WHERE Statut = 'Client'");

                while ($donnees = $reponse->fetch()) { ?>
                    <div class="nom-client-partenaire">
                        <p>
                            <?php echo $donnees['Nom']; ?>
                            <?php echo $donnees['Prenom']; ?>
                        </p>

                    </div>

                <?php } ?>


            </div>
        </div>

        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Partenaire</h2>
                <p>&#9207</p>
            </div>
            <div class="contenu">
                <?php
                $reponse = $bdd->query("SELECT * FROM _utilisateur WHERE Statut = 'Partenaire'");

                while ($donnees = $reponse->fetch()) { ?>
                    <form action="espace-admin-partenaire.php" method="post">
                        <input type="submit" name="entreprise" class="nom-client-partenaire"
                               value="<?php echo $donnees['Nom']; ?>">
                    </form>


                <?php } ?>

                <form action="formulaire%20creer%20compte.php" method="post">
                    <input type="submit" name="boutton-creer-compte" class="nom-client-partenaire" value="+"
                           style="color: green;font-size: 20px">
                </form>
            </div>

        </div>

        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Activités</h2>
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
                    $reponse = $bdd->query("SELECT * FROM _activite");

                    while ($donnees = $reponse->fetch()) {
                        $id = $donnees['ID_activite'];
                        $nom = $donnees['Nom'];
                        $prix = $donnees['Prix'];
                        $description = $donnees['Description'];

                        ?>
                        <tr>
                            <td><?php echo $nom; ?></td>
                            <td><?php echo $prix; ?></td>
                            <td><?php echo $description; ?></td>
                            <td class="td-modifier">
                                <form action="../php/espace-admin-new-activite.php" method="post">
                                    <input type="text" name="id" value="<?php echo $id ?>" style="display: none">
                                    <input class="modifier" type="submit" value="modifier la ligne">
                                </form>
                            </td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="td-modifier">
                            <form action="../php/espace-admin-new-activite.php" method="post">
                                <input type="text" name="id" value="-1" style="display: none">
                                <input class="modifier" type="submit" value="+">
                            </form>
                        </td>

                    </tr>
                </table>


            </div>

        </div>

        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Formules</h2>
                <p>&#9207</p>
            </div>
            <div class="contenu">
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Magasin</th>
                        <th>description</th>
                    </tr>
                    <?php
                    $reponse = $bdd->query("SELECT * FROM _formule");

                    while ($donnees = $reponse->fetch()) {

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
                        ?>
                        <tr>
                            <td><?php echo $nom; ?></td>
                            <td><?php echo $prix; ?></td>
                            <td><?php echo $magasin; ?></td>
                            <td><?php echo $description; ?></td>
                            <td class="td-modifier">
                                <form action="../php/espace-admin-new-formule.php" method="post">
                                    <input type="text" name="id" value="<?php echo $id ?>" style="display: none">
                                    <input class="modifier" type="submit" value="modifier la ligne">
                                </form>
                            </td>
                        </tr>
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