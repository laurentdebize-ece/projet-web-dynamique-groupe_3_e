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
    $entreprise = $_POST["entreprise"];

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Omnes BOX</title>
        <link rel="stylesheet" href="../css/espace-admin-partenaire.css">
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
        <div id="div1">
            <h1> Créer mon compte</h1>
            <form method="post" name="form" action="modifier-supprimer-partenaire.php">
                <?php
                $reponse = $bdd->query('SELECT * FROM _utilisateur WHERE Nom ="' . $entreprise . '"');
                $donnees = $reponse->fetch();
                $id_user = $donnees['ID_utilisateur'];
                ?>

                <input class="texte" type="text" name="id" id="id" value="<?php echo $id_user; ?>" style="display: none" required >

                <label for="nom" id="surname"> Nom Entreprise : </label><br>
                <div class="centrer"><input class="texte" type="text" name="nom" id="nom"
                                            value="<?php echo $entreprise; ?>"><br></div>

                <label for="mail"> e-mail : </label><br>
                <div class="centrer"><input class="texte" type="text" name="mail" id="mail"
                                            value="<?php echo $donnees['Adresse_mail']; ?>"><br></div>
                <?php
                $reponse = $bdd->query('SELECT * FROM _magasin_partenaire WHERE ID_utilisateur ="' . $id_user . '"');
                $donnees = $reponse->fetch()
                ?>
                <label for="Nrue"> Numéro de la rue : </label><br>
                <div class="centrer"><input class="texte" type="text" name="Nrue" id="Nrue"
                                            value="<?php echo $donnees['Numero_rue']; ?>"><br></div>

                <label for="rue"> Rue : </label><br>
                <div class="centrer"><input class="texte" type="text" name="rue" id="rue"
                                            value="<?php echo $donnees['Rue']; ?>"><br></div>

                <label for="CP"> Code Postale : </label><br>
                <div class="centrer"><input class="texte" type="text" name="CP" id="CP"
                                            value="<?php echo $donnees['Code_postal']; ?>"><br></div>

                <label for="ville"> Ville : </label><br>
                <div class="centrer"><input class="texte" type="text" name="ville" id="ville"
                                            value="<?php echo $donnees['Ville']; ?>"><br></div>

                <label for="description"> Déscription : </label><br>
                <div class="centrer"><input class="texte" type="text" name="description" id="description"
                                            value="<?php echo $donnees['Description']; ?>"><br></div>

                <div class="centrer"><input class="boutton" type="submit" name="envoyer" value="Modifier"><input
                            class="boutton-supprimer" type="submit" name="envoyer" value="Supprimer"></div>
            </form>
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