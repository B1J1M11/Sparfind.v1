<?php

include 'server_connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: connexion.php");
    exit();
}

include 'accesMeet.php';

if (isset($_GET["id"])) {
    $meet = LireMeet($_GET["id"]);
}

if ($_SESSION['user_id'] != $meet['user_id']) {
    header("Location: connexion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/modifierCompteStyle.css">
    <title>Compte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include 'menu.php';
    ?>

    <h1 class="titre">Modifier mon compte</h1>

    <div class="modif">
	<form action="TraitementForm/modifierMeet_traitement.php" method="post">
	    <input type="hidden" name="meet_id" value="<?= htmlspecialchars($meet['id']) ?>">

	    <label for="date">Date :</label>
	    <input type="datetime-local" id="date" name="date" value="<?= htmlspecialchars($meet['date']) ?>" required><br>

	    <label for="description">Description :</label>
	    <input type="text" id="description" name="description" value="<?= htmlspecialchars($meet['description']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <button type="submit" name="enregistrer">Enregistrer les modifications</button>
	</form>
    </div>

</body>

</html>
