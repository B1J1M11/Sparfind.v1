<?php

include 'server_connexion.php';

//Interdire l'accès si non connecté 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../connexion.php");
    exit();
}

include 'accesMeet.php';
$user = LireUser($_SESSION["user_id"]);

//Bouton de déconnexion
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: connexion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/compteStyle.css">
    <title>Compte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php include("menu.php"); ?>

    <div class="recap">
        <h1 class="titre">Mon Compte</h1>
        <div class="containerProfil">
            <div class="profil">
                <div class="Nprofil">
                    <h3>Bonjour </h3>
                    <p><?= htmlspecialchars($user['name']) ?> <?= htmlspecialchars($user['lastname']) ?> !</p>
                </div>
                <h3>E-mail :</h3>
                <p> <?= htmlspecialchars($user['email']) ?></p>
                <h3>Age :</h3>
                <p> <?= htmlspecialchars($user['age']) ?></p>
                <h3>Adresse :</h3>
                <p> <?= htmlspecialchars($user['cp']) ?> <?= htmlspecialchars($user['city']) ?>, <?= htmlspecialchars($user['address']) ?></p>
                <h3>Sport principal :</h3>
                <p> <?= htmlspecialchars($user['sport']) ?></p>

                <div class="btnProfil">
                    <div>
                        <button class="btn-modifier" onclick="window.location.href='modifierCompte.php?id=<?php echo $user['id'] ?>'">Modifier compte</button>
                    </div>
                    <div>
                        <form method="post">
                            <button type="submit" name="logout" class="btn-deconnexion">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>