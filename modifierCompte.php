<?php

include 'server_connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: connexion.php");
    exit();
}

include 'accesMeet.php';


if (isset($_GET["id"])) {
    $user = LireUser($_GET["id"]);
}

// Vérifier si l'utilisateur est connecté
if ($user['id'] !== $_SESSION["user_id"]) {
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
	<form action="TraitementForm/modifierCompte_traitement.php" method="post">
	    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">

	    <label for="lastname">Nom :</label>
	    <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç'-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <label for="name">Prénom :</label>
	    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç'-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <label for="age">Age :</label>
	    <input type="number" id="age" name="age" value="<?= htmlspecialchars($user['age']) ?>" required><br>

	    <label for="email">Email :</label>
	    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

	    <label for="cp">Code Postal :</label>
	    <input type="text" id="cp" name="cp" value="<?= htmlspecialchars($user['cp']) ?>" pattern="^[0-9]{5}$" title="Seuls les chiffres sont autorisés." required><br>

	    <label for="city">Ville :</label>
	    <input type="text" id="city" name="city" value="<?= htmlspecialchars($user['city']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç'-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <label for="address">Adresse :</label>
	    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" required><br>

	    <label for="sport">Sport principal :</label>
	    <input type="text" id="sport" name="sport" value="<?= htmlspecialchars($user['sport']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç'-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <label for="niveau">Niveau :</label>
	    <input type="text" id="niveau" name="niveau" value="<?= htmlspecialchars($user['niveau']) ?>" pattern="^[a-zA-Z\séîàèùêâôûëïüç'-]*$" title="Seuls les lettres, les accents, les espaces et les tirets sont autorisés." required><br>

	    <label for="bio">Bio :</label>
	    <input type="text" id="bio" name="bio" value="<?= htmlspecialchars($user['bio']) ?>" required><br>

	    <button type="submit" name="enregistrer">Enregistrer les modifications</button>
	</form>

    </div>

</body>

</html>
