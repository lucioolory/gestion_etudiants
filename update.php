<?php
require 'config.php';

// récupérer l'id de l'étudiant
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// mise à jour si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    $stmt = $pdo->prepare("
        UPDATE etudiants 
        SET nom = ?, prenom = ?, filiere_id = ?
        WHERE id = ?
    ");

    $stmt->execute([$nom, $prenom, $filiere_id, $id]);

    header("Location: index.php");
    exit;
}

// récupérer les données de l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

// récupérer les filières
$filieres = $pdo->query("SELECT * FROM filieres")->fetchAll(PDO::FETCH_ASSOC);

if (!$etudiant) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container">

<h2>Modifier l'étudiant</h2>

<form method="POST">

    <input type="text" name="nom" value="<?= $etudiant['nom'] ?>" required>
    <br><br>

    <input type="text" name="prenom" value="<?= $etudiant['prenom'] ?>" required>
    <br><br>

    <select name="filiere_id" required>
        <option value="">Choisir une filière</option>

        <?php foreach ($filieres as $f): ?>
            <option value="<?= $f['id'] ?>"
                <?= ($f['id'] == $etudiant['filiere_id']) ? 'selected' : '' ?>>
                <?= $f['nom'] ?>
            </option>
        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Modifier</button>

</form>

</div>

</body>
</html> 
