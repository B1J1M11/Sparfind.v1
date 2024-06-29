<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/connexionStyle.css">
    <title>Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include("menu.php");
    ?>

    <div class="contactez-nous">
        <h1>Connexion</h1>
        <form action="TraitementForm/connexion_traitement.php" method="post">
            <div>
                <label for="email">Votre e-mail</label>
                <input type="email" id="email" name="email" placeholder="E-Mail" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div>
                <button type="submit">Se connecter</button>
                <a href="inscription.php">Pas encore de compte ? Créez en un ici !</a>
            </div>
        </form>
    </div>

</body>

</html>
