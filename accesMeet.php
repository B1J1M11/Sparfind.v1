<?php

//--------------------------------------------------------------------------------------//
//--------------- Ce fichier gère uniquement les interactions avec la BD ---------------//
//--------------------------------------------------------------------------------------//

function ConnexionBD()
{
    if (session_status() == PHP_SESSION_NONE) session_start();
    try {
        $mysqlClient = new PDO('mysql:host=localhost;dbname=sparfind;charset=utf8', 'IDENTIFIANT', 'PASSWORD');
        $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $mysqlClient;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
        header("Location: erreur.php?error=server");
        exit();
    }
}


//--------------------------------------- PARTIE USER ---------------------------------------//

//Afficher détails User
function LireUser($idUser)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT * FROM user WHERE user.id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idUser, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

//Ajouter un user en BD
function AjouterUser()
{
    //Dans le formulaire d'inscription
}

//Supprimer un user de la BD
function SupprimerUser($idUser)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'DELETE FROM user WHERE user.id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idUser, PDO::PARAM_INT);
    $statement->execute();
}


//Modifier un user de la BD
function ModifierUser()
{
    //Dans le formulaire
}


//--------- Mail ---------//

//TODO Wagner




//--------------------------------------- PARTIE MEET ---------------------------------------//

//--------- Lecture ---------//

//Lire la liste des Meet en BD
function LireListeMeet()
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT * FROM meet WHERE meet.date >= NOW() ';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Lire la liste des Meet crées par l'utilisateur
function LireListeMeetCree($idUser)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT * FROM meet WHERE meet.date >= NOW() AND meet.user_id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idUser, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Lire la liste des Meet dans lesquels l'user est inscrit
function LireListeMeetInscrit($idUser)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT meet.* FROM meet JOIN meet_user ON meet.id = meet_user.meet_id WHERE meet.date >= NOW() AND meet_user.user_id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idUser, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


//Afficher detail d'un Meet
function LireMeet($idMeet)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT * FROM meet WHERE meet.id = :id ';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idMeet, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

//Afficher la liste des personnes dans le meet
function ListePersonneMeet($idMeet)     
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT u.* FROM meet_user mu JOIN user u ON mu.user_id = u.id WHERE mu.meet_id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idMeet, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Renvoie le nombre de participant dans le Meet (sans prendre en compte le créateur !)
function NombreParticipantsMeet($idMeet)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT COUNT(*) AS nbParticipants FROM meet_user WHERE meet_id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idMeet, PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['nbParticipants'] : 0;
}

//Lecture des messages du Meet
function LireMessagesMeet($idMeet)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT * FROM message WHERE message.meet_id = :id ';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idMeet, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


//--------- Ajouter ---------//

//Ajouter un Meet en BD
function AjouterMeet()
{
    //Dans le formulaire
}


//--------- Supprimer ---------//

//Supprimer un Meet de la BD
function SupprimerMeet($idMeet)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'DELETE FROM meet WHERE meet.id = :id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':id', $idMeet, PDO::PARAM_INT);
    $statement->execute();
}


//--------- Modifier ---------//

//Modifier un Meet de la BD
function ModifierMeet()
{
    //Dans le formulaire
}


//--------- Interagir ---------//

//Rejoindre un Meet
function RejoindreMeet($idMeet, $idUser)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'INSERT INTO meet_user (meet_id, user_id) VALUES (:meet_id, :user_id)';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':meet_id', $idMeet);
    $statement->bindParam(':user_id', $idUser);
    $statement->execute();
}

//Quitter un meet
function QuitterMeet($idUser, $idMeet)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'DELETE FROM meet_user WHERE meet_user.user_id = :user_id AND meet_user.meet_id = :meet_id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':user_id', $idUser);
    $statement->bindParam(':meet_id', $idMeet);
    $statement->execute();
}

//Verification si l'user est inscrit à ce meet
function EstInscritAuMeet($userId, $meetId)
{
    $mysqlClient = ConnexionBD();
    $rSQL = 'SELECT COUNT(*) FROM meet_user WHERE meet_user.user_id = :user_id AND meet_user.meet_id = :meet_id';
    $statement = $mysqlClient->prepare($rSQL);
    $statement->bindParam(':user_id', $userId);
    $statement->bindParam(':meet_id', $meetId);
    $statement->execute();
    $count = $statement->fetchColumn();

    return $count > 0;
}
