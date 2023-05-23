<?php
    
    if(!empty(htmlspecialchars($_POST['mdp'])) && !empty(htmlspecialchars($_POST['confirm_mdp'])) && !empty($_POST['id'])){
        $mot_de_passe = htmlspecialchars($_POST['mdp']);
        $confirm_mdp = htmlspecialchars($_POST['confirm_mdp']);
        $id_utilisateur = $_POST['id'];

    } else {
        header("Location: ../php/Modification%20mdp%20partenaire.php?id=".$id_utilisateur);
        
    }

    if($mot_de_passe === $confirm_mdp){
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
        $reponse = $bdd->query("UPDATE _utilisateur SET Mot_de_passe = '$mot_de_passe' WHERE ID_utilisateur = '$id_utilisateur'");
        $reponse2 = $bdd->query("UPDATE _utilisateur SET Statut = 'Partenaire' WHERE ID_utilisateur = '$id_utilisateur'");
        header("Location: ../php/redirection_connexion.php?success=1");
        exit();

    } else {
        header("Location: ../php/Modification%20mdp%20partenaire.php?id=".$id_utilisateur);
        exit();
    }
?>
        
    

    

