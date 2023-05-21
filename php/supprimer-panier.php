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
$id = $_POST['id'];
echo $id;
$reponse = $bdd->query('DELETE FROM _carte WHERE ID_carte ="' . $id . '"');

header("Location: ../php/Panier.php");
?>