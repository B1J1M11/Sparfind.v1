<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/inscriptionStyle.css">
    <title>Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include("menu.php");
    ?>

    <div class="contactez-nous">
        <h1>Inscription</h1>
        <p>L'union fait la force !</p>

        <form action="TraitementForm/inscription_traitement.php" method="post">
            <div>
                <label for="name">Votre Prénom</label>
                <input type="text" id="name" name="name" placeholder="Prénom" required>
            </div>
            <div>
                <label for="lastname">Votre Nom</label>
                <input type="text" id="lastname" name="lastname" placeholder="Nom" required>
            </div>
            <div>
                <label for="age">Age</label>
                <input type="number" id="age" name="age" placeholder="42" required>
            </div>
            <div>
                <label for="cp">Code Postal</label>
                <input type="text" id="cp" name="cp" placeholder="Code Postal" required>
            </div>
            <div>
                <label for="city">Ville</label>
                <input type="text" id="city" name="city" placeholder="Ville" required>
            </div>
            <div>
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" placeholder="Adresse" required>
            </div>
            <div>
                <label for="email">Votre e-mail</label>
                <input type="email" id="email" name="email" placeholder="E-Mail" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div>
                <label for="sport">Sport principal</label>
                <select name="sport" id="sportSelection">
                    <option value="Mma">MMA</option>
                    <option value="Boxe">Boxe Anglaise</option>
                    <option value="Kick-Boxing">Kick-Boxing</option>
                    <option value="Muay-Thaï">Muay-Thaï</option>
                    <option value="Lutte">Lutte</option>
                    <option value="Grappling">Grappling</option>
                </select>
            </div>
            <div>
                <label for="niveau">Niveau</label>
                <select name="niveau" id="niveauSelection">
                    <option value="Amateur">Amateur</option>
                    <option value="Intermédiaire">Intermédiaire</option>
                    <option value="Avancé">Avancé</option>
                </select>
            </div>
            <div>
                <label for="bio">Biographie</label>
                <input type="text" id="bio" name="bio" placeholder="Brève description de vos attentes et objectifs" required>
            </div>
            <div>
                <button type="submit">Créer mon compte</button>
                <a href="connexion.php">Déjà un compte ? Connectez-vous ici !</a>
            </div>
        </form>

    </div>

</body>

</html>