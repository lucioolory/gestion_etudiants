<?php
require 'config.php';

// récupérer les filières
$stmt = $pdo->query("SELECT * FROM filieres");
$filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// récupérer les étudiants + leurs filières
$stmt2 = $pdo->query("
    SELECT etudiants.*, filieres.nom AS filiere_nom
    FROM etudiants
    INNER JOIN filieres ON etudiants.filiere_id = filieres.id
");
$etudiants = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container">

<h2>Ajouter un étudiant</h2>

<form id="formEtudiant" action="traitement.php" method="POST">

    <input type="text" name="nom" placeholder="Nom">

    <input type="text" name="prenom" placeholder="Prénom">

    <select name="filiere_id">
        <option value="">Choisir une filière</option>

        <?php foreach ($filieres as $filiere): ?>
            <option value="<?= $filiere['id'] ?>">
                <?= $filiere['nom'] ?>
            </option>
        <?php endforeach; ?>

    </select>

    <button type="submit">Ajouter</button>

</form>

<hr>

<h2>Liste des étudiants</h2>

<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Filière</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($etudiants as $etudiant): ?>
    <tr>
        <td><?= $etudiant['nom'] ?></td>
        <td><?= $etudiant['prenom'] ?></td>
        <td><?= $etudiant['filiere_nom'] ?></td>
        <td>
            <a class="edit" href="update.php?id=<?= $etudiant['id'] ?>">Modifier</a>
            <a class="delete" href="delete.php?id=<?= $etudiant['id'] ?>" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</div>

<script src="assets/js/script.js"></script>

</body>
</html>
