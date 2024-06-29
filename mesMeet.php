<?php

include 'server_connexion.php';

//Interdire l'accès si non connecté 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../connexion.php");
    exit();
}

include 'accesMeet.php';
$meetsCrees = LireListeMeetCree($_SESSION["user_id"]);
$meetsInscrits = LireListeMeetInscrit($_SESSION["user_id"]);

if (count($meetsCrees) < 1 && count($meetsInscrits) < 1) {
    header("Location: erreur.php?error=aucunMeet");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/mesMeetStyle.css">
    <title>Mes Meet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<style>
    .containerMeet {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .meet {
        position: relative;
        width: 300px;
        margin: 20px;
        padding: 10px;
        border: 2px solid dodgerblue;
        text-align: center;
        text-decoration: none;
        color: #333;
    }

    .meet:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .meet p {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .meetInscrit {
        border: 2px solid orange;
        /* Spécifiez seulement les propriétés qui changent */
    }
</style>

<body>

    <?php
    include("menu.php");
    ?>

    <div class="containerMeet">
        <?php
        foreach ($meetsCrees as $meet) {
        ?>
            <a href="meet_detail.php?id=<?php echo $meet["id"]; ?>" class="meet style">
                <h3 class="inter">
                    <?php echo $meet["sport"]; ?>
                </h3>
                <h5 class="poppin">
                    <?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($meet["date"]))); ?>
                </h5>
                <h6 class="poppin">
                    <?php echo $meet["description"]; ?>
                </h6>
            </a>
        <?php
        }
        ?>
        <?php
        foreach ($meetsInscrits as $meet) {
        ?>
            <a href="meet_detail.php?id=<?php echo $meet["id"]; ?>" class="meet meetInscrit style">
                <h3 class="inter">
                    <?php echo $meet["sport"]; ?>
                </h3>
                <h5 class="poppin">
                    <?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($meet["date"]))); ?>
                </h5>
                <h6 class="poppin">
                    <?php echo $meet["description"]; ?>
                </h6>
            </a>
        <?php
        }
        ?>
    </div>
</body>

</html>