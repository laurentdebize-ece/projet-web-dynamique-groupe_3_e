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
    <a href="../html/Accueil.html"  ><img id="logo" src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <nav>
        <ol>
            <li id="accueil"><a href="../html/Accueil.html">Accueil</a></li>
            <li id="omnesbox"><a href="../html/OmnesBox.html">Ma OmnesBox</a></li>
            <li id="carte-cadeau"><a href="../php/carte_cadeau.php">Carte cadeau</a></li>
            <li id="icone"><a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a
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
// Connexion à la base de données
$database = "myomnesbox2";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    // Récupération de l'ID de l'activité sélectionnée
    if (isset($_POST['activite_id'])) {
        
        $idActivite = $_POST['activite_id'];
        // Requête pour récupérer les formules selon l'ID de l'activité
        $sql = "SELECT * FROM _activite JOIN _formule ON _activite.ID_activite = _formule.ID_activite WHERE _activite.ID_activite = $idActivite";
        $result = mysqli_query($db_handle, $sql);
        
        // Vérification des résultats de la requête
        if ($result && mysqli_num_rows($result) > 0) {
            // Affichage des formules
            echo '<table>';
            $activite = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                if($activite == 0){
                    echo '<h1>'.$row['DescriptioN'].'</h1>';
                    $activite = 1;
                }
                $idFormule = $row['ID_formule'];
                $descriptionFormule = $row['Description'];
                echo '
                    <tr>
                        <td>'.$descriptionFormule.'</td>
                        <td><form action="../php/carte_cadeau.php" method="post" id="ajout-panier-form">
                            <input name="ajout-panier" id="ajout-panier" class="boutton" type="submit" value="Ajouter au panier">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        } else {
            echo "Aucune formule trouvée.";
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
}

?>
</body>


<footer>
    <a href="../html/Accueil.html" ><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
    <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
</footer>
</body>
</html>
