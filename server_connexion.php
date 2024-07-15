<?php

//Création du fichier de configuration de la base de données

if (session_status() == PHP_SESSION_NONE) session_start();

try {
    $mysqlClient = new PDO('mysql:host=localhost;dbname=sparfind;charset=utf8', 'root', '');
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
    header("Location: erreur.php?error=server");
    exit();
}