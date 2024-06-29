<?php
include 'server_connexion.php';
include 'accesMeet.php';

//Interdire l'accès si non connecté 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../connexion.php");
    exit();
}

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $meet = LireMeet(intval($_GET["id"]));
    $createur = LireUser($meet["user_id"]);
} else {
    header("Location: erreur.php?");
    exit();
}

$messages = LireMessagesMeet($meet["id"]);

$nbParticipant = NombreParticipantsMeet($meet["id"]) + 1;

//Bouton Rejoindre
if (isset($_POST["rejoindre"])) {
    if ($nbParticipant + 1 > $meet["capacite"]) {
        header("Location: erreur.php?error=meetComplet");
        exit();
    }
    RejoindreMeet($meet["id"], $_SESSION["user_id"]);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $meet["id"]);
    exit();
}

//Bouton Quitter
if (isset($_POST["quitter"])) {
    QuitterMeet($_SESSION["user_id"], $meet["id"]);
    header("Location: map.php");
    exit();
}

//Bouton Supprimer
if (isset($_POST["supprimer"])) {
    SupprimerMeet($meet["id"]);
    header("Location: map.php");
    exit();
}

//Bouton Modifier
if (isset($_POST["modifier"])) {
    ModifierMeet($meet["id"]);
    header("Location: map.php");
    exit();
}

//TODO : Tchat entre les participants du meet (visible uniquement si meet rejoint)

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/meetDetailStyle.css">
    <title>Meet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include 'menu.php'; ?>

    <div class="content">
        <div class="meet-details">
            <h2><?php echo htmlspecialchars($meet["sport"]); ?></h2>
            <p><strong>Date :</strong> <?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($meet["date"]))); ?></p>
            <p><strong>Niveau :</strong> <?php echo htmlspecialchars($meet["niveau"]); ?></p>
            <p><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($meet["description"])); ?></p>
            <p><strong>Capacité :</strong> <?php echo htmlspecialchars($meet["capacite"]); ?></p>
            <p><strong>Créateur :</strong> <?php echo htmlspecialchars($createur["name"] . " " . $createur["lastname"]); ?></p>

            <?php if ($_SESSION["user_id"] == $meet["user_id"]) { ?>
                <div class="btnAdminMeet">
                    <button class="btn-modifier" onclick="window.location.href='modifierMeet.php?id=<?php echo $meet['id'] ?>'">Modifier le Meet</button>
                    <form method="post">
                        <button type="submit" name="supprimer">Supprimer le Meet</button>
                    </form>
                </div>
            <?php } else { ?>
                <div class="btnMeet">
                    <?php if (!EstInscritAuMeet($_SESSION["user_id"], $meet["id"]) && $nbParticipant < $meet["capacite"]) { ?>
                        <form method="post">
                            <button type="submit" name="rejoindre">Rejoindre le Meet</button>
                        </form>
                    <?php } ?>
                    <?php if (EstInscritAuMeet($_SESSION["user_id"], $meet["id"])) { ?>
                        <form method="post">
                            <button type="submit" name="quitter">Quitter le Meet</button>
                        </form>
                    <?php } ?>
                    <?php if (!EstInscritAuMeet($_SESSION["user_id"], $meet["id"]) && $nbParticipant >= $meet["capacite"]) { ?>
                        <p>Meet complet !</p>
                        <form method="post">
                            <button type="submit" name="quitter">Trouver un Meet</button>
                        </form>
                    <?php } ?>

                </div>
            <?php } ?>

            <!-- Section pour les participants -->
            <div class="participants">
                <h2>Participants</h2>
                <div class="participant-list">
                    <div class="detailAdmin">
                        <p><?php echo htmlspecialchars($createur["name"]); ?> <?php echo htmlspecialchars($createur["lastname"]); ?></p>
                        <p><?php echo htmlspecialchars($createur["age"]); ?> ans</p>
                        <p><?php echo htmlspecialchars($createur["sport"]); ?></p>
                        <p><?php echo htmlspecialchars($createur["niveau"]); ?></p>
                        <p><?php echo htmlspecialchars($createur["bio"]); ?></p>
                    </div>
                    <?php
                    $participants = ListePersonneMeet($meet["id"]); // Fonction pour lire les participants du meet
                    foreach ($participants as $participant) { ?>
                        <div class="participant">
                            <p><?php echo htmlspecialchars($participant["name"]); ?> <?php echo htmlspecialchars($participant["lastname"]); ?></p>
                            <p><?php echo htmlspecialchars($participant["age"]); ?> ans</p>
                            <p><?php echo htmlspecialchars($participant["sport"]); ?></p>
                            <p><?php echo htmlspecialchars($participant["niveau"]); ?></p>
                            <p><?php echo htmlspecialchars($participant["bio"]); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Zone de Tchat -->
        <!--Tchat visible uniquement si inscrit au Meet (ou  créateur) -->
        <?php if (EstInscritAuMeet($_SESSION["user_id"], $meet["id"]) || $createur["id"] == $_SESSION["user_id"]) { ?>
            <div class="tchat">
                <h2>Tchat</h2>
                <div class="tchatMessage">
                    <?php foreach ($messages as $message) {
                        $userName = LireUser($message["user_id"]);
                    ?>
                        <p><strong><?php echo htmlspecialchars($userName["name"]); ?></strong></p>
                        <p><?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($message["date"]))); ?></p>
                        <p><?php echo htmlspecialchars(html_entity_decode($message["texte"])); ?></p>
                    <?php } ?>
                </div>
		<form action="TraitementForm/sendMessage_traitement.php" method="post" class="tchatForm">
		    <input type="hidden" name="meet_id" value="<?= htmlspecialchars($meet['id']) ?>">

		    <input type="text" id="texte" name="texte" placeholder="Entrez votre message..." required pattern="^[a-zA-Z\séîàèùêâôûëïüç-]*$" title="Seuls les lettres, les accents et les espaces sont autorisés.">
		    <button type="submit" name="sendMessage">Envoyer</button>
		</form>

            </div>
        <?php } ?>
    </div>
</body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #695D61;
    }

    .content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 20px;
        margin: 0;
    }

    .meet-details {
        flex: 1;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-right: 20px;
        background-color: #f9f9f9;
    }

    .tchat {
        flex: 1;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        max-width: 40%;
    }

    @media (max-width: 800px) {
    .tchat {
        max-width: 100%
    }
  }

    .tchatMessage {
        height: 400px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
        overflow-y: auto;
        padding: 10px;
        background-color: #fff;
    }

    .tchatForm {
        display: flex;
    }

    .tchatForm input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px 0 0 5px;
    }

    button {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 0 5px 5px 0;
        background-color: #F97000;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #fc943f;
    }

    .participants {
        margin-top: 20px;
    }

    .participant-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .participant {
        flex: 1 1 calc(50% - 10px);
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
    }

    .detailAdmin {
        flex: 1 1 calc(50% - 10px);
        padding: 10px;
        border: 1px solid #007bff;
        border-radius: 5px;
        background-color: #fff;
    }
</style>

</html>
