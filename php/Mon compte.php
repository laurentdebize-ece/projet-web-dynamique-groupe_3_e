<?php
        
    //on récupère les données du formulaire
    $adresse_mail = isset($_POST["mail"])? $_POST["mail"] : "";
    $mot_de_passe = isset($_POST["mp"])? $_POST["mp"] : "";


    
    //identifier BDD
    $database = "myomnesbox";
    
    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    //si le BDD existe, faire le traitement
    if($db_found){
        //echo 'BDD trouvée <br>';
        $sql = "SELECT * FROM _utilisateur WHERE Adresse_mail = '$adresse_mail' AND Mot_de_passe = '$mot_de_passe'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        //regarder s'il y a de résultat
        
        if(mysqli_num_rows($result) == 0){
            echo '
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <title>Redirection</title>
                    <meta http-equiv="refresh" content="3; URL=../php/Mon%20compte1.php">
                </head>
                <body>
                    <h1>Erreur</h1>
                    <p>Adresse-mail ou Mot de passe incorrect.</p>
                    <p>Vous allez être redirigé vers la page de connexion.</p>
                </body>
            ';
        } else {

            // Commencer une nouvelle session
            session_start();

            // Stocker les données utilisateur dans des variables de session
            $_SESSION["connecte"] = true;
            $_SESSION["ID"] = $data['ID_utilisateur']; 
            $_SESSION["Adresse_mail"] = $data['Adresse_mail']; 
            $_SESSION["Mot_de_passe"] = $data['Mot_de_passe'];
            $_SESSION["Nom"] = $data['Nom'];
            $_SESSION["Prenom"] = $data['Prenom'];
            $_SESSION["Statut"] = $data['Statut'];
            

            echo'
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Mon compte</title>
                <link rel="stylesheet" href="../css/Mon%20compte2.css">
                <script src="../js/Mon compte.js"></script>
            </head>
            <body>
            <header>
                <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
                <nav>
                    <ol>
                        <li> <a href="../html/Accueil.html">Accueil</a> </li>
                        <li> <a href="../html/OmnesBox.html">Ma OmnesBox</a> </li>
                        <li> <a href="../html/carte-cadeau.html">Carte cadeau</a> </li>
                        <li> <a href="../html/Panier.html"><img src="../image/panier.png" alt="icone-panier"></a><a href="../php/Mon%20compte1.php"><img src="../image/compte.png" alt="icone-compte"></a> </li>
                    </ol>
                </nav>
                <div id="ligne"></div>
            
            </header>
            <section>
                <div id="div1">
                    <div class="centrer"> <img src="../image/compte2.png" alt="icone-compte"></div>
                    <h1>'. $data['Nom'] . '  ' . $data['Prenom'] . '</h1>
                    <div class="mail-mp"><p class="intituler" >Adresse-mail :  </p><p class="donner" > ' . $data['Adresse_mail'] . '</p></div>
                    <div class="mail-mp"><p class="intituler" >Mot de passe :  </p><p class="donner"> '  . $data['Mot_de_passe'] . '</p></div>
                    <div class="mail-mp"><p class="intituler" >Statut :  </p><p class="donner"> ' . $data['Statut'] . '</p></div>
                </div>
            </section>
            <footer>
                <a href="../html/Accueil.html"><img src="../image/logo%20site.png" alt="logo" class="logo"></a>
                <p>Created by Le Quellec, Chaperon, Fornier, Bouroullec</p>
            </footer>
            
            </body>
            </html>
            ';
        }    


    }
    
    // Fermer la connexion à la base de données
    mysqli_close($db_handle);
?>
