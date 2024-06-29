<!--

Nous recherchons :

    un(e) UX designer
    un(e) développeur(euse) back-end
    un(e) développeur(euse) front-end

Bien sûr, en tant que projet étudiant, aucun financement n'est prévu, mais si vous êtes passionné(e) et talentueux(se), il pourrait vous arriver la même chose qu'à David Choe...  
Si vous êtes intéressé(e), veuillez nous contacter à contact@sparfind.com !

-->
<?php

//EasterEgg
$random = rand(1, 1000);
if ($random === 1) {
    $titre = "Règle numéro 1 : On ne parle pas de Sparfind...";
} else {
    $titre = "Bienvenue sur Sparfind";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sparfind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/helloStyle.css">
    <link rel="icon" href="imports/logosfind.png" type="image/png">
</head>
<body>
    <?php include "menu.php" ?>
    <div class="spacer layer1 boite_gen">
        <section class="dad magic">
            <div class="rel_size">
                <h1 class="titles"> <?php echo $titre; ?> </h1>
                <p class="text">Découvrez Sparfind, l'application qui révolutionne votre expérience sportive ! Vous cherchez un partenaire d'entraînement à votre niveau ? Sparfind est là pour vous. Que vous soyez débutant ou athlète confirmé, notre plateforme vous met en relation avec des sportifs partageant les mêmes objectifs et aspirations.

                    Avec Sparfind, trouvez facilement des compagnons d'entraînement pour des sessions motivantes et productives. Améliorez vos performances, explorez de nouvelles disciplines et partagez votre passion du sport avec une communauté dynamique et engagée.

                    Rejoignez-nous dès aujourd'hui et donnez une nouvelle dimension à votre pratique sportive !</p>
            </div>
            <div class="rel_size center_image">
                <img src="imports/logosfind.png" alt="">
            </div>
        </section>
    </div>
    <div class="wave range">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
    <section class="dad range magic">
        <div class="rel_size">
            <h1 class="titles">Un Meet pour tous !</h1>
            <p class="text">Comment rejoindre une rencontre Sparfind ?
            Rien de plus simple ! Pour participer à une rencontre sur Sparfind, accédez à la carte interactive de l'application et cliquez sur n'importe quelle icône Meet pour obtenir toutes les informations relatives à l'entraînement proposé. Vérifiez les détails tels que l'heure, le lieu, le niveau requis et le type d'entraînement. Si le Meet que vous avez sélectionné vous convient, cliquez sur "Rejoindre" et vous êtes prêt ! Présentez-vous à l'endroit indiqué à l'heure prévue pour commencer votre séance d'entraînement. Rejoignez la communauté Sparfind et profitez de séances d'entraînement motivantes avec des partenaires de votre niveau ! </p>
        </div>
        <div class="rel_size">
            <a href="map.php" class=""><img src="imports/map.png" class="border_image_map mom" alt=""></a>
        </div>
    </section>
    </div>
    <div class="wave2">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill2"></path>
        </svg>
    </div>
    <section class="dad magic">
        <div class=" rel_size lourd">
            <a href="map.php"><img class="mom border_image_meet" src="imports/dos.png" alt=""></a>
        </div>
        <div class="rel_size">
            <h1 class="titles">Créer vos Meets !</h1>
            <p class="text">
                Vous ne trouvez pas de rencontre qui vous convient ? Pas de souci ! Sur Sparfind, créez votre propre Meet en quelques étapes simples. Organisez une séance d'entraînement adaptée à vos besoins et à votre emploi du temps en spécifiant le type d'entraînement, le niveau requis, le lieu et l'heure. Publiez votre rencontre et laissez la magie de Sparfind opérer ! D'autres sportifs partageant vos aspirations pourront rejoindre votre Meet pour une séance dynamique et motivante. Prenez les rênes de votre entraînement et enrichissez votre expérience sportive avec de nouveaux partenaires grâce à Sparfind !</p>
        </div>
    </section>
</body>

</html>
