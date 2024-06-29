<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/erreurStyle.css">
    <title>Erreur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include("menu.php");
    ?>

    <?php
    // Récupérer le paramètre d'erreur de l'URL
    $errorType = isset($_GET['error']) ? $_GET['error'] : 'default';
    $errorMessage = "Une erreur inconnue s'est produite.";
    $titreRedirection = "Retour";
    $redirection = "accueil.php"; // Redirection par défaut

    // Gestion du message et de la redirection selon l'erreur
    switch ($errorType) {
        case 'age':
            $errorMessage = "Vous devez avoir au moins 18 ans pour vous inscrire.";
            $titreRedirection = "S'inscrire";
            $redirection = "inscription.php";
            break;
        case 'email_exists':
            $errorMessage = "Un utilisateur avec cet email existe déjà.";
            $titreRedirection = "S'inscrire";
            $redirection = "inscription.php";
            break;
        case 'server':
            $errorMessage = "Une erreur serveur s'est produite. Veuillez réessayer plus tard.";
            $titreRedirection = "Retour";
            $redirection = "acceuil.php";
            break;
        case 'wrong_emailPwd':
            $errorMessage = "Email ou mot de passe incorrect.";
            $titreRedirection = "S'identifier";
            $redirection = "connexion.php";
            break;
        case 'aucunMeet':
            $errorMessage = "Vous n'avez créé et/ou rejoint aucun Meet !";
            $titreRedirection = "Créer ou rejoindre un Meet";
            $redirection = "map.php";
            break;
        case 'meetComplet':
            $errorMessage = "Ce Meet est complet !";
            $titreRedirection = "Créer ou rejoindre un Meet";
            $redirection = "map.php";
            break;
        default:
            $errorMessage = "Une erreur inconnue s'est produite.";
            $titreRedirection = "Retour";
            $redirection = "accueil.php";
            break;
    }
    ?>

    <div class="panierVide">
        <p> <?php echo htmlspecialchars($errorMessage); ?></p>
        <a href="<?php echo htmlspecialchars($redirection); ?>"><?php echo htmlspecialchars($titreRedirection); ?></a>
    </div>
</body>

</html>