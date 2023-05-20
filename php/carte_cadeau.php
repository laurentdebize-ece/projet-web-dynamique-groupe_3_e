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
            <li><a href="../html/OmnesBox.html">Ma OmnesBox</a></li>
            <li><a href="../php/carte_cadeau.php">Carte cadeau</a></li>
            <li><a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a
                    href="../php/redirection_connexion.php"><img src="../image/compte.png" alt="icone-compte"></a></li>
        </ol>
    </nav>
    <div id="ligne"></div>

</header>

<?php
    // Connexion à la base de données
    $database = "myomnesbox2";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $NomPrecedent = "vide";
?>

<section>
    <div id="contenaire-all-carte">
        <div class="row">
            <?php
            if ($db_found) {
                // Requête pour récupérer les activités
                $sql = "SELECT * FROM _activite";
                $result = mysqli_query($db_handle, $sql);
                $row = mysqli_fetch_assoc($result);
                
                while ($row != false) {
                    $nextRow = mysqli_fetch_assoc($result);
                    $nom = $row['Nom'];
                    $montant = $row['Prix'];
                    $activite_id = $row['ID_activite'];
                    if($nom != $NomPrecedent){
                        echo '<div class="col-sm-4">
                                <div class="contenaire-carte">
                                    <img class="image" src="../image/carte-cadeau.png" alt="carte cadeau">
                                    <div class="contenaire-all-prix"> ';
                    }
            
                    echo '              <div class="contenaire-prix">
                                            <p class="euro">€</p>
                                            <form action="../php/formule.php" method="post">
                                                <input type="hidden" name="activite_id" value="' . $activite_id . '">
                                                <input type="submit" value="' . $montant . '">
                                            </form>
                                        </div>';
                                   
                    if($nextRow == false  || $nextRow['Nom'] != $nom)  {
                        echo '
                                    </div>
                                </div>
                            <h3 class="titre"><?php echo $nom; ?></h3>
                            </div>';
                    }
                    $NomPrecedent = $nom;
                    $row = $nextRow;
                }
                // Fermeture de la connexion à la base de données
                mysqli_close($db_handle);
            }
            ?>
        </div>
    </div>
</section>


<footer>
    <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>

