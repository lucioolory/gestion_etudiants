<?php
require 'config.php';

// vérifier si les données existent
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['filiere_id'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    // requête préparée
    $sql = "INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $filiere_id]);

    // redirection
    header("Location: index.php");
    exit();
}
?>
