<?php
session_start();

try {
    // Connexion à la base de données MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
    // Définition du mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Affichage de l'erreur en cas d'échec de la connexion
    die('Erreur : ' . $e->getMessage());
}

if ($_SESSION["Statut"] === 'Administrateur') {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Omnes BOX</title>
        <link rel="stylesheet" href="../css/espace-admin-client.css">
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
        <?php
        $ID = $_POST["id"];
        $reponse = $bdd->query('SELECT * FROM _utilisateur WHERE ID_utilisateur ="' . $ID . '" ');
        $donnees = $reponse->fetch() ?>
        <h2><?php echo $donnees['Nom']; ?><?php echo $donnees['Prenom']; ?></h2>
        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Cartes cadeau achetées </h2>
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
                    try {
                        // Connexion à la base de données MySQL
                        $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
                        // Définition du mode d'erreur de PDO sur Exception
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (Exception $e) {
                        // Affichage de l'erreur en cas d'échec de la connexion
                        die('Erreur : ' . $e->getMessage());
                    }
                    $reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur ="' . $ID . '" AND Panier = 0 ');

                    while ($donnees = $reponse->fetch()) {
                        $reponse2 = $bdd->query('SELECT * FROM _formule WHERE ID_formule ="' . $donnees["ID_formule"] . '" ');
                        $donnees2 = $reponse2->fetch();

                        ?>
                        <tbody>
                        <tr class="produit">
                            <td><img class="image" src="../image/carte-cadeau.png">
                                <p><?php echo $donnees2["Description"]; ?></p></td>
                            <td class="prix"><?php echo $donnees["Prix"]; ?> €</td>
                        </tr>
                        </tbody>
                        <?php
                    }
                    ?></table>
            </div>
        </div>
        <div id="client" class="contenaire">
            <div class="contenaire-titre">
                <h2 class="titre">Cartes cadeau bénéficier</h2>
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
                    try {
                        // Connexion à la base de données MySQL
                        $bdd = new PDO('mysql:host=localhost;dbname=myomnesbox;charset=utf8', 'root', '');
                        // Définition du mode d'erreur de PDO sur Exception
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (Exception $e) {
                        // Affichage de l'erreur en cas d'échec de la connexion
                        die('Erreur : ' . $e->getMessage());
                    }
                    $reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur__beneficie ="' . $ID . '" AND Panier = 0 ');

                    while ($donnees = $reponse->fetch()) {
                        $reponse2 = $bdd->query('SELECT * FROM _formule WHERE ID_formule ="' . $donnees["ID_formule"] . '" ');
                        $donnees2 = $reponse2->fetch();

                        ?>
                        <tbody>
                        <tr class="produit">
                            <td><img class="image" src="../image/carte-cadeau.png">
                                <p><?php echo $donnees2["Description"]; ?></p></td>
                            <td class="prix"><?php echo $donnees["Prix"]; ?> €</td>
                        </tr>
                        </tbody>
                        <?php
                    }
                    ?></table>
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