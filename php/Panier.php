<?php
// Démarrer une nouvelle session
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == false) {

    // Rediriger l'utilisateur vers la page de connexion
    header("Location: ../php/Mon%20compte%20non%20connecte.php");

} else {
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Panier</title>
        <link rel="stylesheet" href="../css/Panier.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="../js/Panier.js"></script>
    </head>
    <body>
    <header>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <nav>
            <ol>
                <li><a href="../html/Accueil.html">Accueil</a></li>
                <li><a href="OmnesBox.php">Ma OmnesBox</a></li>
                <li><a href="carte_cadeau.php">Carte cadeau</a></li>
                <li><a href="Panier.php"><img src="../image/panier.png" alt="icone-panier"></a><a
                            href="redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
            </ol>
        </nav>
        <div id="ligne"></div>

    </header>
    <section>

        <div>
            <h1>Panier d'achat</h1>
        </div>
        <div class="contenu">
            <table>
                <thead>
                <tr>
                    <th>Produits</th>
                    <th>Montant</th>
                    <th>Quantité</th>
                    <th>Sous-Total</th>
                    <th></th>
                </tr>
                </thead>
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
                $reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur ="' . $_SESSION["ID"] . '" AND Panier = 1 ');

                while ($donnees = $reponse->fetch()) {
                    $reponse2 = $bdd->query('SELECT * FROM _formule WHERE ID_formule ="' . $donnees["ID_formule"] . '" ');
                    $donnees2 = $reponse2->fetch();

                    ?>
                    <tbody>
                    <tr class="produit">
                        <td><img class="image" src="../image/carte-cadeau.png">
                            <p><?php echo $donnees2["Description"]; ?></p></td>
                        <td class="prix"><?php echo $donnees["Prix"]; ?></td>
                       <!-- <td><input class="nombre" type="number" name="nombre" value="1"></td>-->
                        <td><div class="contenaire-nombre"><input class="boutton-nombre" value="-" type="button" ><p class="nombre">1</p><input class="boutton-nombre" type="button" value="+"></div></td>
                        <td class="sous-totale"><?php echo $donnees["Prix"]; ?></td>
                        <td>
                            <form action="../php/supprimer-panier.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $donnees["ID_carte"]; ?>">
                                <input class="poubelle"
                                       type="image"
                                       src="../image/poubelle.png"

                                       alt="poubelle">
                            </form>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                }
                ?></table>
            <div id="recapitulatif">
                <h2>Récapitulatif de commande</h2>
                <div class="ligne2"></div>
                <div id="prix-total">
                    <h3 id="nb-articles"></h3>
                    <h3 id="prix-total2"></h3>
                </div>
                <div class="ligne2"></div>
                <a href="../html/achat.html"> <input class="boutton" type="button" value="Commander"></a>
            </div>
        </div>
    </section>
    <footer>
        <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
        <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
    </footer>
    </body>
    </html>
    <?php


}
?>

