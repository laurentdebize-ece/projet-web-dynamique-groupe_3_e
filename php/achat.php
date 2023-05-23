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
$reponse = $bdd->query('SELECT * FROM _carte WHERE ID_utilisateur ="' . $_SESSION["ID"] . '" AND Panier = 1 ');

while ($donnees = $reponse->fetch()) {
    $nb = $_POST[''.$donnees["ID_carte"]];

    ?>
    <script>console.log(<?php echo $nb ;?>)</script>
    <?php
    $dt = time();
    $reponse = $bdd->query('UPDATE _carte SET Panier = 0 , Date_achat ="' . date( "Y-m-d", $dt) . '" WHERE ID_utilisateur ="' . $_SESSION["ID"] . '"');
    $nb--;
    while ($nb != 0){
        $dt = time();
        $reponse = $bdd->query('INSERT INTO _carte (Prix, ID_utilisateur, ID_activite, Panier,Date_achat) VALUES ("' . $donnees["Prix"] . '", "' . $_SESSION["ID"] . '", "' . $donnees["ID_activite"] . '", 0, "' . date( "Y-m-d", $dt) . '")');
        $nb--;
    }

}
header("Location: ../html/Accueil.html");
?>