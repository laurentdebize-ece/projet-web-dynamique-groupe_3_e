<?php
        
    //on récupère les données du formulaire
    $adresse_mail = isset($_POST["mail"])? $_POST["mail"] : "";
    $mot_de_passe = isset($_POST["mp"])? $_POST["mp"] : "";


    
    //identifier BDD
    $database = "myomnesbox";
    
    //connectez-vous dans BDD
    
    // Configuration pour WAMP
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    
    $db_found = mysqli_select_db($db_handle, $database);


    //si le BDD existe, faire le traitement
    if($db_found){
        //echo 'BDD trouvée <br>';
        $sql = "SELECT * FROM _utilisateur WHERE Adresse_mail = '$adresse_mail' AND Mot_de_passe = '$mot_de_passe'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        //regarder s'il y a de résultat
        
        if(mysqli_num_rows($result) == 0){
            echo '<script type="text/javascript">alert("Adresse mail ou mot de passe incorrect");</script>';
            sleep(2);
            header("Location: ../php/Mon%20compte%20non%20connecte.php");
        } else {

            //Regarder si l'utilisateur est un futur partenaire
            if($data['Statut'] === "Futur Partenaire"){
                header("Location: ../php/Modification%20mdp%20partenaire.php?id=".$data['ID_utilisateur']);
                exit();
            }

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
            echo "connecter";

            header("Location: ../php/Mon_compte_connecte.php");
        }    


    }
    
    
    // Fermer la connexion à la base de données
    mysqli_close($db_handle);
?>
